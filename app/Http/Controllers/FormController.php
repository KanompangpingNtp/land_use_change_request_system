<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\FormLandOwnerDetail;
use App\Models\LandDetailsRequest;
use App\Models\LandDetail;
use App\Models\ChangeNotification;
use App\Models\LandChangeNotification;
use App\Models\FormAttachment;

class FormController extends Controller
{
    //
    public function FormIndex()
    {
        return view('users_form.users_form');
    }

    public function FormCreate(Request $request)
    {
        // การตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม
        $request->validate([
            'request_date' => 'required|date',
            'guest_salutation' => 'nullable|string',
            'guest_name' => 'nullable|string|max:255',
            'guest_age' => 'nullable|integer|min:0',
            'guest_phone' => 'nullable|string|max:15',
            'guest_house_number' => 'nullable|string|max:255',
            'guest_village' => 'nullable|string|max:255',
            'guest_subdistrict' => 'nullable|string|max:255',
            'guest_district' => 'nullable|string|max:255',
            'guest_province' => 'required|string|max:255',

            'land_owner_details_name' => 'required|string|max:255',
            'land_owner_details_area' => 'required|string|max:255',
            'land_owner_details_farm' => 'required|string|max:255',
            'land_owner_details_square_wa' => 'required|string|max:255',
            'land_owner_details_village' => 'required|string|max:255',

            'land_details_request' => 'required|in:building,no_buildings',
            'land_details_quantity' => 'nullable|integer|min:0',

            'land_details' => 'required|array|min:1|max:3',
            'land_details.*.number' => 'required|string|max:255',
            'land_details.*.name' => 'required|string|max:255',
            'land_details.*.width' => 'required|numeric|min:0',
            'land_details.*.length' => 'required|numeric|min:0',
            'land_details.*.age' => 'required|numeric|min:0',

            'land_change_notifications_quantity' => 'nullable|integer|min:0',

            'land_change_notifications.*.name' => 'required|string',
            'land_change_notifications.*.quantity_land' => 'required|numeric',
            'land_change_notifications.*.farm' => 'required|string',
            'land_change_notifications.*.square_wa' => 'required|numeric',

            'attachments.*' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:10240',
        ]);

        // dd($request->all());

        $form = Form::create([
            'user_id' => Auth::id(),
            'request_date' => $request->request_date,
            'guest_salutation' => $request->guest_salutation,
            'guest_name' => $request->guest_name,
            'guest_age' => $request->guest_age,
            'guest_phone' => $request->guest_phone,
            'guest_house_number' => $request->guest_house_number,
            'guest_village' => $request->guest_village,
            'guest_subdistrict' => $request->guest_subdistrict,
            'guest_district' => $request->guest_district,
            'guest_province' => $request->guest_province,
            'status' => 1,  // Default status
        ]);

        if ($request->has('land_owner_details_name')) {
            FormLandOwnerDetail::create([
                'form_id' => $form->id, // เชื่อมโยงกับ form_id
                'land_owner_details_name' => $request->land_owner_details_name,
                'land_owner_details_area' => $request->land_owner_details_area,
                'land_owner_details_farm' => $request->land_owner_details_farm,
                'land_owner_details_square_wa' => $request->land_owner_details_square_wa,
                'land_owner_details_village' => $request->land_owner_details_village,
            ]);
        }

        if ($request->has('land_details_request')) {
            LandDetailsRequest::create([
                'form_id' => $form->id,
                'land_details' => $request->land_details_request, // ค่า 'building' หรือ 'no_buildings'
                'land_details_quantity' => $request->land_details_quantity,
            ]);
        }

        if ($request->has('land_details')) {
            foreach ($request->land_details as $landDetail) {
                LandDetail::create([
                    'form_id' => $form->id,  // เชื่อมโยงกับ form_id
                    'land_details_number' => $landDetail['number'],
                    'land_details_name' => $landDetail['name'],
                    'land_details_width' => $landDetail['width'],
                    'land_details_length' => $landDetail['length'],
                    'land_details_age' => $landDetail['age'],
                ]);
            }
        }

        if ($request->has('land_change_notifications_quantity')) {
            ChangeNotification::create([
                'form_id' => $form->id,  // ใช้ form_id ที่สร้างไว้จากฟอร์มก่อนหน้านี้
                'land_change_notifications_quantity' => $request->land_change_notifications_quantity,
            ]);
        }

        foreach ($request->land_change_notifications as $notification) {
            LandChangeNotification::create([
                'form_id' => $form->id,  // ฟอร์ม ID ที่เชื่อมโยงกับข้อมูลนี้
                'land_change_notifications_name' => $notification['name'],
                'land_change_notifications_quantity_land' => $notification['quantity_land'],
                'land_change_notifications_farm' => $notification['farm'],
                'land_change_notifications_square_wa' => $notification['square_wa'],
            ]);
        }

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
                $filename = time() . '_' . $file->getClientOriginalName();

                // เก็บไฟล์ใน public/storage/attachments
                $path = $file->storeAs('attachments', $filename, 'public'); // ใช้ disk ที่ระบุเป็น 'public'

                // สร้างบันทึกข้อมูลใน FormAttachment
                FormAttachment::create([
                    'form_id' => $form->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ข้อมูลถูกส่งเรียบร้อยแล้ว');
    }
}
