@extends('layout.admin_layout')
@section('admin_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<!-- Form for filling out -->
<div class="container">
    <a href="{{ route('adminshowform')}}">กลับหน้าเดิม</a><br><br>
    <h3 class="text-center">แก้ไขข้อมูลฟอร์ม</h3>
    <form action="{{ route('adminformupdate', $form->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                Form
            </div>
            <div class="card-body">
                <div class="mb-3 col-md-2">
                    <label for="request_date" class="form-label">วันที่ขอ</label>
                    <input type="date" class="form-control" id="request_date" name="request_date" value="{{ old('request_date', $form->request_date) }}" required>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-2">
                        <label for="guest_salutation" class="form-label">คำนำหน้า</label>
                        <select class="form-select" id="guest_salutation" name="guest_salutation">
                            <option value="" disabled>เลือกคำนำหน้า</option>
                            <option value="นาย" {{ old('guest_salutation', $form->guest_salutation) == 'นาย' ? 'selected' : '' }}>นาย</option>
                            <option value="นาง" {{ old('guest_salutation', $form->guest_salutation) == 'นาง' ? 'selected' : '' }}>นาง</option>
                            <option value="นางสาว" {{ old('guest_salutation', $form->guest_salutation) == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" value="{{ old('guest_name', $form->guest_name) }}">
                    </div>
                    <div class="mb-3 col-md-1">
                        <label for="guest_age" class="form-label">อายุ</label>
                        <input type="number" class="form-control" id="guest_age" name="guest_age" value="{{ old('guest_age', $form->guest_age) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_phone" class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ old('guest_phone', $form->guest_phone) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_house_number" class="form-label">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ old('guest_house_number', $form->guest_house_number) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_village" class="form-label">หมู่ที่</label>
                        <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ old('guest_village', $form->guest_village) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_subdistrict" class="form-label">ตำบล</label>
                        <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ old('guest_subdistrict', $form->guest_subdistrict) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_district" class="form-label">อำเภอ</label>
                        <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ old('guest_district', $form->guest_district) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_province" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ old('guest_district', $form->guest_province) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Land Owner Details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="land_owner_details_name" class="form-label">ชื่อเจ้าของที่ดิน</label>
                        <input type="text" class="form-control" id="land_owner_details_name" name="land_owner_details_name" value="{{ old('land_owner_details_name', $form->landOwnerDetails->first()->land_owner_details_name) }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_area" class="form-label">พื้นที่</label>
                        <input type="text" class="form-control" id="land_owner_details_area" name="land_owner_details_area" value="{{ old('land_owner_details_area', $form->landOwnerDetails->first()->land_owner_details_area ?? '') }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_farm" class="form-label">ไร่</label>
                        <input type="text" class="form-control" id="land_owner_details_farm" name="land_owner_details_farm" value="{{ old('land_owner_details_farm', $form->landOwnerDetails->first()->land_owner_details_farm ?? '') }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_square_wa" class="form-label">ตรว.</label>
                        <input type="text" class="form-control" id="land_owner_details_square_wa" name="land_owner_details_square_wa" value="{{ old('land_owner_details_square_wa', $form->landOwnerDetails->first()->land_owner_details_square_wa ?? '') }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_village" class="form-label">หมู่บ้าน</label>
                        <input type="text" class="form-control" id="land_owner_details_village" name="land_owner_details_village" value="{{ old('land_owner_details_village', $form->landOwnerDetails->first()->land_owner_details_village ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Land Details Request
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3">
                        <label for="land_details_request" class="form-label">รายละเอียดที่ดิน</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="land_details_building" name="land_details_request" value="building" {{ old('land_details_request', $landDetailsRequest->land_details) == 'building' ? 'checked' : '' }}>
                            <label class="form-check-label" for="land_details_building">สิ่งปลูกสร้าง</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="land_details_no_building" name="land_details_request" value="no_buildings" {{ old('land_details_request', $landDetailsRequest->land_details) == 'no_buildings' ? 'checked' : '' }}>
                            <label class="form-check-label" for="land_details_no_building">ไม่มีสิ่งปลูกสร้าง</label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_details_quantity" class="form-label">จำนวน</label>
                        <input type="number" class="form-control" id="land_details_quantity" name="land_details_quantity" value="{{ old('land_details_quantity', $form->landDetailsRequests->first()->land_details_quantity ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Land Details
                <button type="button" class="btn btn-sm btn-primary float-end" onclick="addLandDetails()">เพิ่มฟอร์ม</button>
            </div>
            <div class="card-body" id="land-details-container">
                @foreach ($form->landDetails as $index => $landDetail)
                <div class="land-details-form">
                    <div class="row">
                        <input type="hidden" name="land_details[{{ $index }}][id]" value="{{ $landDetail->id }}">
                        <div class="form-group col-md-2">
                            <label for="land_details_number_{{ $index + 1 }}">เลขที่ที่ดิน</label>
                            <input type="text" class="form-control" id="land_details_number_{{ $index + 1 }}" name="land_details[{{ $index }}][number]" value="{{ old('land_details.' . $index . '.number', $landDetail->land_details_number) }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="land_details_name_{{ $index + 1 }}">นามที่ดิน</label>
                            <input type="text" class="form-control" id="land_details_name_{{ $index + 1 }}" name="land_details[{{ $index }}][name]" value="{{ old('land_details.' . $index . '.name', $landDetail->land_details_name) }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="land_details_width_{{ $index + 1 }}">ความกว้าง</label>
                            <input type="number" class="form-control" id="land_details_width_{{ $index + 1 }}" name="land_details[{{ $index }}][width]" value="{{ old('land_details.' . $index . '.width', $landDetail->land_details_width) }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="land_details_length_{{ $index + 1 }}">ความยาว</label>
                            <input type="number" class="form-control" id="land_details_length_{{ $index + 1 }}" name="land_details[{{ $index }}][length]" value="{{ old('land_details.' . $index . '.length', $landDetail->land_details_length) }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="land_details_age_{{ $index + 1 }}">อายุที่ดิน</label>
                            <input type="number" class="form-control" id="land_details_age_{{ $index + 1 }}" name="land_details[{{ $index }}][age]" value="{{ old('land_details.' . $index . '.age', $landDetail->land_details_age) }}" required>
                        </div>
                    </div>
                    <hr>
                </div>
                @endforeach
            </div>
        </div>

        <!-- การแจ้งเตือนการเปลี่ยนแปลง (Change Notifications) -->
        <div class="card mt-4">
            <div class="card-header">
                Change Notifications
            </div>
            <div class="card-body">
                <div class="form-group col-md-2">
                    <label for="land_change_notifications_quantity">จำนวนบุคคล</label>
                    <input type="number" class="form-control" id="land_change_notifications_quantity" name="land_change_notifications_quantity" value="{{ old('land_change_notifications_quantity', $form->changeNotifications->first()->land_change_notifications_quantity ?? '') }}" required>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Land Change Notifications
                <button type="button" class="btn btn-sm btn-primary float-end" onclick="addLandChangeNotification()">เพิ่มฟอร์ม</button>
            </div>
            <div class="card-body">
                <div id="land-change-notifications-container">
                    @foreach ($form->landChangeNotifications as $index => $landChangeNotification)
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="land_change_notifications_name{{ $index + 1 }}">นาม</label>
                            <input type="text" class="form-control" id="land_change_notifications_name{{ $index + 1 }}" name="land_change_notifications[{{$index}}][name]" value="{{ old('land_change_notifications.' . $index . '.name', $landChangeNotification->land_change_notifications_name) }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="land_change_notifications_quantity_land{{ $index + 1 }}">จำนวน</label>
                            <input type="number" class="form-control" id="land_change_notifications_quantity_land{{ $index + 1 }}" name="land_change_notifications[{{$index}}][quantity_land]" value="{{ old('land_change_notifications.' . $index . '.quantity_land', $landChangeNotification->land_change_notifications_quantity_land) }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="land_change_notifications_farm{{ $index + 1 }}">ไร่</label>
                            <input type="text" class="form-control" id="land_change_notifications_farm{{ $index + 1 }}" name="land_change_notifications[{{$index}}][farm]" value="{{ old('land_change_notifications.' . $index . '.farm', $landChangeNotification->land_change_notifications_farm) }}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="land_change_notifications_square_wa{{ $index + 1 }}">งาน</label>
                            <input type="number" class="form-control" id="land_change_notifications_square_wa{{ $index + 1 }}" name="land_change_notifications[{{$index}}][square_wa]" value="{{ old('land_change_notifications.' . $index . '.square_wa', $landChangeNotification->land_change_notifications_square_wa) }}" required>
                        </div>
                        <input type="hidden" name="land_change_notifications[{{$index}}][id]" value="{{ $landChangeNotification->id }}">
                    </div>
                    @endforeach


                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                แนบไฟล์ (ถ้ามี)
            </div>
            <div class="card-body">
                <div class="mb-3 col-md-5">
                    <label for="attachments" class="form-label">เลือกไฟล์</label>
                    <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                </div>
                <div class="mb-3 col-md-8">
                    <label>ไฟล์ที่แนบไว้แล้ว:</label>
                    @foreach ($form->attachments as $attachment)
                    <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ basename($attachment->file_path) }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
        </div>
    </form>
</div>

<script>
    let landDetailsCount = {
        {
            count($form - > landDetails)
        }
    };

    function addLandDetails() {
        if (landDetailsCount >= 3) {
            alert('สามารถเพิ่มฟอร์มได้สูงสุด 3 ฟอร์ม');
            return;
        }

        landDetailsCount++;

        const container = document.getElementById('land-details-container');
        const landDetailsForm = document.createElement('div');
        landDetailsForm.classList.add('land-details-form');
        landDetailsForm.innerHTML = `
        <div class="row">
            <input type="hidden" name="land_details[${landDetailsCount - 1}][id]" value="">
            <div class="form-group col-md-2">
                <label for="land_details_number_${landDetailsCount}">เลขที่ที่ดิน</label>
                <input type="text" class="form-control" id="land_details_number_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][number]" required>
            </div>
            <div class="form-group col-md-4">
                <label for="land_details_name_${landDetailsCount}">นามที่ดิน</label>
                <input type="text" class="form-control" id="land_details_name_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][name]" required>
            </div>
            <div class="form-group col-md-2">
                <label for="land_details_width_${landDetailsCount}">ความกว้าง</label>
                <input type="number" class="form-control" id="land_details_width_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][width]" required>
            </div>
            <div class="form-group col-md-2">
                <label for="land_details_length_${landDetailsCount}">ความยาว</label>
                <input type="number" class="form-control" id="land_details_length_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][length]" required>
            </div>
            <div class="form-group col-md-2">
                <label for="land_details_age_${landDetailsCount}">อายุที่ดิน</label>
                <input type="number" class="form-control" id="land_details_age_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][age]" required>
            </div>
        </div>
        <hr>
    `;

        container.appendChild(landDetailsForm);
    }

</script>

<script>
    let landChangeNotificationsCount = {
        {
            count($form - > landChangeNotifications)
        }
    };

    function addLandChangeNotification() {
        if (landChangeNotificationsCount >= 4) {
            alert('สามารถเพิ่มฟอร์มได้สูงสุด 4 ฟอร์ม');
            return;
        }

        landChangeNotificationsCount++;

        const container = document.getElementById('land-change-notifications-container');
        const formGroup = document.createElement('div');
        formGroup.classList.add('land-change-notification-form');
        formGroup.innerHTML = `
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="land_change_notifications_name_${landChangeNotificationsCount}">Change Name</label>
                    <input type="text" class="form-control" id="land_change_notifications_name_${landChangeNotificationsCount}" name="land_change_notifications[${landChangeNotificationsCount - 1}][name]" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="land_change_notifications_quantity_land_${landChangeNotificationsCount}">Quantity of Land</label>
                    <input type="number" class="form-control" id="land_change_notifications_quantity_land_${landChangeNotificationsCount}" name="land_change_notifications[${landChangeNotificationsCount - 1}][quantity_land]" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="land_change_notifications_farm_${landChangeNotificationsCount}">Farm</label>
                    <input type="text" class="form-control" id="land_change_notifications_farm_${landChangeNotificationsCount}" name="land_change_notifications[${landChangeNotificationsCount - 1}][farm]" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="land_change_notifications_square_wa_${landChangeNotificationsCount}">Square Wa</label>
                    <input type="number" class="form-control" id="land_change_notifications_square_wa_${landChangeNotificationsCount}" name="land_change_notifications[${landChangeNotificationsCount - 1}][square_wa]" required>
                </div>
            </div>
            <hr>
        `;

        // เพิ่มฟอร์มใหม่เข้าไปใน container
        container.appendChild(formGroup);
    }

</script>
@endsection
