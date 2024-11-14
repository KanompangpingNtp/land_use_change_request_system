<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Form;
use App\Models\FormLandOwnerDetail;
use App\Models\LandDetailsRequest;
use App\Models\LandDetail;
use App\Models\ChangeNotification;
use App\Models\LandChangeNotification;
use App\Models\FormAttachment;
use App\Models\Reply;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminFormController extends Controller
{
    //
    public function adminshowform()
    {
        $forms = Form::with(['user', 'replies', 'attachments'])->get();

        // ส่งข้อมูลไปยัง view
        return view('admin_show_form.admin_show_form', compact('forms'));
    }

    public function adminshowformedit($id)
    {
        $form = Form::with([
            'attachments',
            'landOwnerDetails',
            'landDetailsRequests',
            'landDetails',
            'changeNotifications',
            'landChangeNotifications'
        ])->findOrFail($id);

        $landDetailsRequest = $form->landDetailsRequests->first();

        return view('admin_edit_form.admin_edit_form', compact('form','landDetailsRequest')); // ส่งข้อมูลไปยัง view
    }

    public function adminformupdate(Request $request, $id)
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

        // ค้นหาฟอร์มที่ต้องการอัปเดต
        $form = Form::findOrFail($id);

        // อัปเดตข้อมูลในฟอร์ม
        $form->update([
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

        // อัปเดตข้อมูลใน FormLandOwnerDetail ถ้ามีการส่งข้อมูลมา
        if ($request->has('land_owner_details_name')) {
            FormLandOwnerDetail::updateOrCreate(
                ['form_id' => $form->id], // ค้นหาข้อมูลที่มีอยู่แล้ว
                [
                    'land_owner_details_name' => $request->land_owner_details_name,
                    'land_owner_details_area' => $request->land_owner_details_area,
                    'land_owner_details_farm' => $request->land_owner_details_farm,
                    'land_owner_details_square_wa' => $request->land_owner_details_square_wa,
                    'land_owner_details_village' => $request->land_owner_details_village,
                ]
            );
        }

        // อัปเดตข้อมูลใน LandDetailsRequest ถ้ามีการส่งข้อมูลมา
        if ($request->has('land_details_request')) {
            LandDetailsRequest::updateOrCreate(
                ['form_id' => $form->id], // ค้นหาข้อมูลที่มีอยู่แล้ว
                [
                    'land_details' => $request->land_details_request, // ค่า 'building' หรือ 'no_buildings'
                    'land_details_quantity' => $request->land_details_quantity,
                ]
            );
        }

        if ($request->has('land_details')) {
            foreach ($request->land_details as $landDetail) {
                if (isset($landDetail['id'])) {
                    // อัปเดตข้อมูลถ้ามี id อยู่แล้ว
                    LandDetail::updateOrCreate(
                        [
                            'id' => $landDetail['id'], // ใช้ id ในการค้นหาข้อมูล
                            'form_id' => $form->id,
                        ],
                        [
                            'land_details_number' => $landDetail['number'],
                            'land_details_name' => $landDetail['name'],
                            'land_details_width' => $landDetail['width'],
                            'land_details_length' => $landDetail['length'],
                            'land_details_age' => $landDetail['age'],
                        ]
                    );
                } else {
                    // สร้างข้อมูลใหม่ถ้าไม่มี id
                    LandDetail::create([
                        'form_id' => $form->id,
                        'land_details_number' => $landDetail['number'],
                        'land_details_name' => $landDetail['name'],
                        'land_details_width' => $landDetail['width'],
                        'land_details_length' => $landDetail['length'],
                        'land_details_age' => $landDetail['age'],
                    ]);
                }
            }
        }


        // อัปเดตข้อมูลใน ChangeNotification ถ้ามีการส่งข้อมูลมา
        if ($request->has('land_change_notifications_quantity')) {
            ChangeNotification::updateOrCreate(
                ['form_id' => $form->id], // ค้นหาข้อมูลที่มีอยู่แล้ว
                [
                    'land_change_notifications_quantity' => $request->land_change_notifications_quantity,
                ]
            );
        }

        if ($request->has('land_change_notifications')) {
            foreach ($request->land_change_notifications as $landChangeNotification) {
                if (isset($landChangeNotification['id'])) {
                    // อัปเดตข้อมูลถ้ามี id อยู่แล้ว
                    LandChangeNotification::updateOrCreate(
                        [
                            'id' => $landChangeNotification['id'], // ใช้ id ในการค้นหาข้อมูล
                            'form_id' => $form->id,
                        ],
                        [
                            'land_change_notifications_name' => $landChangeNotification['name'],
                            'land_change_notifications_quantity_land' => $landChangeNotification['quantity_land'],
                            'land_change_notifications_farm' => $landChangeNotification['farm'],
                            'land_change_notifications_square_wa' => $landChangeNotification['square_wa'],
                        ]
                    );
                } else {
                    // สร้างข้อมูลใหม่ถ้าไม่มี id
                    LandChangeNotification::create([
                        'form_id' => $form->id,
                        'land_change_notifications_name' => $landChangeNotification['name'],
                        'land_change_notifications_quantity_land' => $landChangeNotification['quantity_land'],
                        'land_change_notifications_farm' => $landChangeNotification['farm'],
                        'land_change_notifications_square_wa' => $landChangeNotification['square_wa'],
                    ]);
                }
            }
        }


        // อัปเดตไฟล์แนบ
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

        return redirect()->back()->with('success', 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว');
    }

    public function adminReply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // dd($request);
        // dd(auth()->id());

        Reply::create([
            'form_id' => $formId,
            'user_id' => auth()->id(),
            'reply_text' => $request->message,
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }

    public function exportPDF($id)
    {
        $form = Form::with(
            'landOwnerDetails',
            'landDetailsRequests',
            'landDetails',
            'changeNotifications',
            'landChangeNotifications'
        )->find($id);

        // สร้าง instance ของ DomPDF ผ่าน facade Pdf
        $pdf = Pdf::loadView('admin_export_pdf.admin_export_pdf', compact('form'))
            ->setPaper('A4', 'portrait');

        // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
        return $pdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf');
    }

    public function updateStatus($id)
    {
        $form = Form::findOrFail($id);

        // อัปเดตสถานะ
        $form->status = 2; // หรือค่าที่คุณต้องการ
        $form->admin_name_verifier = Auth::user()->name; // เก็บ fullname ของผู้ล็อกอิน
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }
}
