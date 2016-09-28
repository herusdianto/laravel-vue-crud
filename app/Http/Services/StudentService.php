<?php

namespace App\Http\Services;

use Storage;

class StudentService
{

    /**
     * @param $request
     * @param $student
     */
    public function uploadAvatar($request, $student)
    {
        $fileName = str_random(30);
        $extension = $request->avatar->extension();
        $fullFileName = "{$fileName}.{$extension}";

        if ($request->avatar->storeAs('public/avatars', $fullFileName)) {
            $student->avatar = $fullFileName;
        }
    }

    /**
     * @param $student
     */
    public function deleteCurrentAvatar($student)
    {
        $currentAvatar = $student->avatar;

        if($currentAvatar) {
            $file = "public/avatars/{$currentAvatar}";

            if(Storage::exists($file)) {
                Storage::delete($file);
            }
        }
    }

    /**
     * @param $request
     * @param $student
     */
    public function saveStudent($request, $student)
    {
        $student->name = $request->name;
        $student->email = $request->email;
        $student->birth_date = $request->birth_date;
        $student->save();
    }

}