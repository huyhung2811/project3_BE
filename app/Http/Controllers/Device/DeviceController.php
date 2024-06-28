<?php

namespace App\Http\Controllers\Device;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DeviceController extends Controller
{
    public function checkDeviceStatus(Request $request)
    {
        $MAC_address = $request->MAC_address;
        $updateTime = Carbon::now();
        if (Device::where('MAC_address', $MAC_address)->first()) {
            Device::where('MAC_address', $MAC_address)->update(['updated_time' => $updateTime]);
            return response()->json([
                'message' => 'Success',
            ]);
        } else {
            $data = [
                'MAC_address' => $MAC_address,
                'updated_time' => $updateTime,
            ];
            Device::insert($data);
        }
    }

    public function showDevices(Request $request)
    {
        $currentDay = Carbon::now()->toDateString();
        $query = Device::query();

        if ($request->has('building') && $request->building) {
            $building = $request->building;
            $rooms = Room::where('building', $building)->pluck('id');
            $query->whereIn('room_id', $rooms);
        }

        if ($request->has('room') && $request->room) {
            $room = $request->room;
            $room_ids = Room::where('room', $room)->pluck('id');
            $query->whereIn('room_id', $room_ids);
        }
        if ($request->has('status') && $request->status) {
            $status = $request->status;
            if ($status == 'active') {
                $query->whereDate('updated_time', $currentDay);
            } elseif ($status == 'inactive') {
                $query->whereDate('updated_time', '!=', $currentDay);
            }
        }

        $devices = $query->paginate($request->rowPerPage ?? 10);

        if ($devices->isEmpty()) {
            return response()->json([
                'message' => 'Không có thiết bị!',
            ], 404);
        }

        $data = [];
        foreach ($devices as $device) {
            $data[] = [
                'id' => $device->id,
                'MAC_address' => $device->MAC_address,
                'room' => $device->room->building . "-" . $device->room->room,
                'updated_time' => $device->updated_time,
                'status' => Carbon::parse($device->updated_time)->toDateString() === $currentDay ? 'active' : 'inactive',
            ];
        }
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data,
            $devices->total(),
            $devices->perPage(),
            $devices->currentPage(),
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return response()->json([
            'devices' => $paginator,
        ]);
    }

    public function updateDevice(Request $request)
    {
        $id = $request->id;
        $data = [];

        $data['MAC_address'] = $request->MAC_address;
        $room_id = Room::where('building', $request->building)
            ->where('room', $request->room)->first()->id;
        $data['room_id'] = $room_id;
        Device::where('id', $id)->update($data);
        return response()->json(['message' => 'Sửa thành công!'], 200);
    }

    public function deleteDevice(Request $request)
    {
        if (Device::find($request->id)->delete()) {
            return response()->json([
                'message' => 'Xóa thành công!'
            ], 200);
        }
    }
}
