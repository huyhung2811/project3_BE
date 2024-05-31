<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\EducationalSystem;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $profile = $user->students[0];
        $class = $profile->class;
        $system = EducationalSystem::find($class->system_id);
        $unit = $class->unit; 
        
        $data = [
            'student_code' => $profile->student_code,
            'name' => $profile->name,
            'birth_date' => $profile->birth_date,
            'phone' => $profile->phone,
            'address' => $profile->address,
            'home_town' => $profile->home_town,
            'email' => $profile->email,
            'avatar' => $profile->avatar == null || $profile->avatar == '' ? asset('assets/images/default_avatar.jpg') : $profile->avatar,
            'student_class' => $class->name,
            'system' => $system->name,
            'unit' => $unit->name
        ];

        return response()->json($data, 200);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = [
            'phone' => $request->phone,
            'address' => $request->address,
            'home_town' => $request->home_town,
            'avatar' => $request->avatar,
        ];
        $update_time = Carbon::now()->format('Y_m_d_His');
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = 'avatar_' . $user->id. '_'. $update_time .'.' . $image->getClientOriginalExtension();
            $image->move('assets/images', $imageName);
            $data['avatar'] = asset('assets/images/avatar_' . $user->id . '_' . $update_time .'.' . $image->getClientOriginalExtension());
        }

        if(Student::where('email', $user->email)->update($data)){
            $profile = $user->students[0];
            $class = $profile->class;
            $system = EducationalSystem::find($class->system_id);
            $unit = $class->unit; 
            $data = [
                'student_code' => $profile->student_code,
                'name' => $profile->name,
                'birth_date' => $profile->birth_date,
                'phone' => $profile->phone,
                'address' => $profile->address,
                'home_town' => $profile->home_town,
                'email' => $profile->email,
                'avatar' => $profile->avatar == null || $profile->avatar == '' ? asset('assets/images/default_avatar.jpg') : $profile->avatar,
                'student_class' => $class->name,
                'system' => $system->name,
                'unit' => $unit->name
            ];
    
            return response()->json([
                'message' => 'Cập nhật thành công',
                'data' => $data,
            ], 200);
        }
    }
}
