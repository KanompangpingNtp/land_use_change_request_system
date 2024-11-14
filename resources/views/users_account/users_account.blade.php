@extends('layout.users_account_layout')

@section('account_layout')

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success'
        , title: '{{ $message }}'
    , })

</script>
@endif

<div class="container">
    <form action="{{ route('FormCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                Form
            </div>
            <div class="card-body">
                <div class="mb-3 col-md-2">
                    <label for="request_date" class="form-label">วันที่ขอ</label>
                    <input type="date" class="form-control" id="request_date" name="request_date" required>
                </div>
                {{-- <div class="row">
                    <div class="mb-3 col-md-2">
                        <label for="guest_salutation" class="form-label">คำนำหน้า</label>
                        <select class="form-select" id="guest_salutation" name="guest_salutation">
                            <option value="" selected disabled>เลือกคำนำหน้า</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_age" class="form-label">อายุ</label>
                        <input type="number" class="form-control" id="guest_age" name="guest_age">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_phone" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="guest_phone" name="guest_phone">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_house_number" class="form-label">หมายเลขบ้าน</label>
                        <input type="text" class="form-control" id="guest_house_number" name="guest_house_number">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_village" class="form-label">หมู่บ้าน</label>
                        <input type="text" class="form-control" id="guest_village" name="guest_village">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_subdistrict" class="form-label">ตำบล</label>
                        <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_district" class="form-label">อำเภอ</label>
                        <input type="text" class="form-control" id="guest_district" name="guest_district">
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="guest_salutation" class="form-label">คำนำหน้า</label>
                        <select class="form-select" id="guest_salutation" name="guest_salutation" required>
                            <option value="" disabled {{ $user->userDetails->salutation ? '' : 'selected' }}>เลือกคำนำหน้า</option>
                            <option value="นาย" {{ $user->userDetails->salutation == 'นาย' ? 'selected' : '' }}>นาย</option>
                            <option value="นาง" {{ $user->userDetails->salutation == 'นาง' ? 'selected' : '' }}>นาง</option>
                            <option value="นางสาว" {{ $user->userDetails->salutation == 'นางสาว' ? 'selected' : '' }}>นางสาว</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_name" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control" id="guest_name" name="guest_name" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3 col-md-1">
                        <label for="guest_age" class="form-label">อายุ</label>
                        <input type="number" class="form-control" id="guest_age" name="guest_age" value="{{ $user->userDetails->age }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_occupation" class="form-label">อาชีพ</label>
                        <input type="text" class="form-control" id="guest_occupation" name="guest_occupation" value="{{ $user->userDetails->occupation }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_phone" class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" id="guest_phone" name="guest_phone" value="{{ $user->userDetails->phone }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_house_number" class="form-label">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="guest_house_number" name="guest_house_number" value="{{ $user->userDetails->house_number }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_village" class="form-label">หมู่ที่</label>
                        <input type="text" class="form-control" id="guest_village" name="guest_village" value="{{ $user->userDetails->village }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_subdistrict" class="form-label">ตำบล</label>
                        <input type="text" class="form-control" id="guest_subdistrict" name="guest_subdistrict" value="{{ $user->userDetails->subdistrict }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="guest_district" class="form-label">อำเภอ</label>
                        <input type="text" class="form-control" id="guest_district" name="guest_district" value="{{ $user->userDetails->district }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="guest_province" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="guest_province" name="guest_province" value="{{ $user->userDetails->guest_province }}">
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
                        <input type="text" class="form-control" id="land_owner_details_name" name="land_owner_details_name">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_area" class="form-label">พื้นที่</label>
                        <input type="text" class="form-control" id="land_owner_details_area" name="land_owner_details_area">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_farm" class="form-label">ไร่</label>
                        <input type="text" class="form-control" id="land_owner_details_farm" name="land_owner_details_farm">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_square_wa" class="form-label">ตรว.</label>
                        <input type="text" class="form-control" id="land_owner_details_square_wa" name="land_owner_details_square_wa">
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_owner_details_village" class="form-label">หมู่บ้าน</label>
                        <input type="text" class="form-control" id="land_owner_details_village" name="land_owner_details_village">
                    </div>
                </div>
            </div>
        </div>

        <!-- รายละเอียดคำขอที่ดิน (Land Details Request) -->
        <div class="card mt-4">
            <div class="card-header">
                Land Details Request
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mb-3">
                        <label for="land_details_request" class="form-label">รายละเอียดที่ดิน</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="land_details_building" name="land_details_request" value="building">
                            <label class="form-check-label" for="land_details_building">สิ่งปลูกสร้าง</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="land_details_no_building" name="land_details_request" value="no_buildings">
                            <label class="form-check-label" for="land_details_no_building">ไม่มีสิ่งปลูกสร้าง</label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="land_details_quantity" class="form-label">จำนวน</label>
                        <input type="number" class="form-control" id="land_details_quantity" name="land_details_quantity">
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
                    <div class="land-details-form">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="land_details_number_1">เลขที่ที่ดิน</label>
                                <input type="text" class="form-control" id="land_details_number_1" name="land_details[0][number]" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="land_details_name_1">นามที่ดิน</label>
                                <input type="text" class="form-control" id="land_details_name_1" name="land_details[0][name]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="land_details_width_1">ความกว้าง</label>
                                <input type="number" class="form-control" id="land_details_width_1" name="land_details[0][width]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="land_details_length_1">ความยาว</label>
                                <input type="number" class="form-control" id="land_details_length_1" name="land_details[0][length]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="land_details_age_1">อายุที่ดิน</label>
                                <input type="number" class="form-control" id="land_details_age_1" name="land_details[0][age]" required>
                            </div>
                        </div>
                        <hr>
                    </div>
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
                        <input type="number" class="form-control" id="land_change_notifications_quantity" name="land_change_notifications_quantity" required>
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
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="land_change_notifications_name">นาม</label>
                                <input type="text" class="form-control" id="land_change_notifications_name" name="land_change_notifications[0][name]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="land_change_notifications_quantity_land">จำนวน</label>
                                <input type="number" class="form-control" id="land_change_notifications_quantity_land" name="land_change_notifications[0][quantity_land]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="land_change_notifications_farm">ไร่</label>
                                <input type="text" class="form-control" id="land_change_notifications_farm" name="land_change_notifications[0][farm]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="land_change_notifications_square_wa">งาน</label>
                                <input type="number" class="form-control" id="land_change_notifications_square_wa" name="land_change_notifications[0][square_wa]" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- ฟอร์มสำหรับการแนบไฟล์ -->
        <div class="card mt-4">
            <div class="card-header">
                แนบไฟล์ (ถ้ามี)
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="attachments" class="form-label">เลือกไฟล์</label>
                    <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
        </div>
    </form>
</div>

<script src="{{asset('js_test/users_form.js')}}"></script>

@endsection
