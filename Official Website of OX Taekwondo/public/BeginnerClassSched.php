<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beginners Class Schedule</title>
    <link rel="stylesheet" href="../css/ClassSched.css">
</head>
<body>
    <div class="scheduleContainer">
        <h2>BEGINNERS CLASS SCHEDULE</h2>
        
        <label class="privateCheckbox">
            <input type="checkbox" id="private" onclick="toggleSchedule()"> Private
        </label>
        
        <!-- Regular Schedule -->
        <div id="regularSchedule" class="schedule">
            <div class="schedule">
                <div class="day">Sunday</div>
                <div class="day">Monday</div>
                <div class="day">Tuesday</div>
                <div aclass="day">Wednesday</div>
                <div class="day">Thursday</div>
                <div class="day">Friday</div>
                <div class="day">Saturday</div>
    
                <div class="slot" data-day="Sunday">
                    <input type="checkbox" id="sunday-morning" name="slot" value="10:00 - 11:30 AM">
                    <label for="sunday-morning">10:00 - 11:30 AM <span class="status">Available</span></label>
                    <br>
                    <input type="checkbox" id="sunday-afternoon" name="slot" value="04:00 - 05:30 PM">
                    <label for="sunday-afternoon">04:00 - 05:30 PM <span class="status">Available</span></label>
                </div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="slot" data-day="Saturday">
                    <input type="checkbox" id="saturday-morning" name="slot" value="10:00 - 11:30 AM">
                    <label for="saturday-morning">10:00 - 11:30 AM <span class="status">Available</span></label>
                    <br>
                    <input type="checkbox" id="saturday-afternoon" name="slot" value="04:00 - 05:30 PM">
                    <label for="saturday-afternoon">04:00 - 05:30 PM <span class="status">Available</span></label>
                </div>
            </div>
        </div>
        

        <!-- Private Schedule -->
        <div id="privateSchedule" class="schedule" style="display: none;">
            <div class="schedule">
                <div class="day">Sunday</div>
                <div class="day">Monday</div>
                <div class="day">Tuesday</div>
                <div class="day">Wednesday</div>
                <div class="day">Thursday</div>
                <div class="day">Friday</div>
                <div class="day">Saturday</div>
    
                <div class="empty"></div>
    
                <div class="slot" data-day="Monday">
                  <input type="checkbox" id="mondayAfternoon1" name="slot" value="01:00 - 02:30 PM">
                  <label for="mondayAfternoon1">01:00 - 02:30 PM <span class="status">Available</span></label>
                  <br>
                  <input type="checkbox" id="mondayAfternoon2" name="slot" value="03:00 - 04:30 PM">
                  <label for="mondayAfternoon2">03:00 - 04:30 PM <span class="status">Available</span></label>
                </div>
                
                <div class="slot" data-day="Tuesday">
                <input type="checkbox" id="tuesdayAfternoon1" name="slot" value="01:00 - 02:30 PM">
                <label for="tuesdayAfternoon1">01:00 - 02:30 PM <span class="status">Available</span></label>
                <br>
                <input type="checkbox" id="tuesdayAfternoon2" name="slot" value="03:00 - 04:30 PM">
                <label for="tuesdayAfternoon2">03:00 - 04:30 PM <span class="status">Available</span></label>
                </div>
    
                <div class="slot" data-day="Wednesday">
                <input type="checkbox" id="wednesdayAfternoon1" name="slot" value="01:00 - 02:30 PM">
                <label for="wednesdayAfternoon1">01:00 - 02:30 PM <span class="status">Available</span></label>
                <br>
                <input type="checkbox" id="wednesdayAfternoon2" name="slot" value="03:00 - 04:30 PM">
                <label for="wednesdayAfternoon2">03:00 - 04:30 PM <span class="status">Available</span></label>
                </div>
    
                <div class="slot" data-day="Thursday">
                  <input type="checkbox" id="thursdayAfternoon1" name="slot" value="01:00 - 02:30 PM">
                  <label for="thursdayAfternoon1">01:00 - 02:30 PM <span class="status">Available</span></label>
                  <br>
                  <input type="checkbox" id="thursdayAfternoon2" name="slot" value="03:00 - 04:30 PM">
                  <label for="thursdayAfternoon2">03:00 - 04:30 PM <span class="status">Available</span></label>
                  </div>
    
                <div class="empty"></div>
                <div class="empty"></div>
            </div>
        </div>
        <p class="availability-info">Slots Available: 2</p>
        <p class="advisory">Please be advised that you can only choose 2 slots.</p>
        <button class="confirm-button" onclick="confirmSelection()">CONFIRM</button>

        <form id="scheduleForm" action="../PHP/schedule_process.php" method="POST">
            <input type="hidden" name="selectedSlots" id="selectedSlots">
        </form>
    </div>

    <script>
        // Function to toggle between regular and private schedule
        function toggleSchedule() {
            const privateCheckbox = document.getElementById("private");
            const regularSchedule = document.getElementById("regularSchedule");
            const privateSchedule = document.getElementById("privateSchedule");
            const availabilityInfo = document.querySelector('.availability-info');
        
            if (privateCheckbox.checked) {
                regularSchedule.style.display = "none";
                privateSchedule.style.display = "block";
            } else {
                regularSchedule.style.display = "block";
                privateSchedule.style.display = "none";
            }
            updateAvailabilityInfo(); // Update availability info after toggling
        }
        
        let selectedSlots = [];
        const maxSlots = 2; // Maximum slots allowed
        const availabilityInfo = document.querySelector('.availability-info');
        
        // Update the "Slots Available" text
        function updateAvailabilityInfo() {
            const remainingSlots = maxSlots - selectedSlots.length;
            availabilityInfo.textContent = `Slots Available: ${remainingSlots}`;
        }
        
        function handleSlotSelection(event) {
            const selectedSlot = event.target;
        
            if (selectedSlot.checked) {
                // Add the slot to selectedSlots if checked
                if (selectedSlots.length < maxSlots) {
                    selectedSlots.push(selectedSlot);
                } else {
                    selectedSlot.checked = false; // Uncheck the slot if max is reached
                    alert("You can only choose up to 2 slots.");
                }
            } else {
                // Remove the slot from selectedSlots if unchecked
                selectedSlots = selectedSlots.filter(slot => slot !== selectedSlot);
            }
        
            // Update the "Slots Available" text
            updateAvailabilityInfo();
        }
        
        function confirmSelection() {
            if (selectedSlots.length === maxSlots) {
                // Get values of selected slots
                const selectedValues = selectedSlots.map(slot => slot.value);
                
                // Submit the form with selected values
                const scheduleForm = document.getElementById('scheduleForm');
                document.getElementById('selectedSlots').value = selectedValues.join(', ');
                scheduleForm.submit();
            } else {
                alert("Please select exactly 2 slots before confirming.");
            }
        }
        
        // Attach event listeners to checkboxes for each slot
        document.querySelectorAll('input[name="slot"]').forEach(slot => {
            slot.addEventListener('change', handleSlotSelection);
        });
        
        // Initialize the "Slots Available" text
        updateAvailabilityInfo();
    </script>
</body>
</html>
