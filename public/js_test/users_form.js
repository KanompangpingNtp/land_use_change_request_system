
let landDetailsCount = 1; // Start with one set of inputs

function addLandDetails() {
    if (landDetailsCount >= 3) {
        alert('สามารถเพิ่มฟอร์มได้สูงสุด3ฟอร์ม');
        return;
    }

    landDetailsCount++;

    const container = document.getElementById('land-details-container');
    const landDetailsForm = document.createElement('div');
    landDetailsForm.classList.add('land-details-form');
    landDetailsForm.innerHTML = `
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="land_details_number_${landDetailsCount}">Land Number</label>
                    <input type="text" class="form-control" id="land_details_number_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][number]" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="land_details_name_${landDetailsCount}">Land Name</label>
                    <input type="text" class="form-control" id="land_details_name_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][name]" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="land_details_width_${landDetailsCount}">Width</label>
                    <input type="number" class="form-control" id="land_details_width_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][width]" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="land_details_length_${landDetailsCount}">Length</label>
                    <input type="number" class="form-control" id="land_details_length_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][length]" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="land_details_age_${landDetailsCount}">Age</label>
                    <input type="number" class="form-control" id="land_details_age_${landDetailsCount}" name="land_details[${landDetailsCount - 1}][age]" required>
                </div>
            </div>
            <hr>
        `;

    container.appendChild(landDetailsForm);
}

let landChangeNotificationsCount = 1; // ตั้งค่าตัวนับให้เริ่มต้นที่ 1 เนื่องจากมีฟอร์มเริ่มต้นอยู่แล้ว

function addLandChangeNotification() {
    if (landChangeNotificationsCount >= 4) {
        alert('สามารถเพิ่มฟอร์มได้สูงสุด4ฟอร์ม');
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

    container.appendChild(formGroup);
}

