// Function to handle payment success
function handlePaymentSuccess() {
    alert("Payment successful! Redirecting to homepage...");
    window.location.href = "../public/index.html"; // Update this path to your index page
}

// Function to handle payment failure
function handlePaymentFailure() {
    alert("Payment failed. Please try again.");
}

// Function to simulate payment response for testing (remove this in production)
function simulatePaymentResponse(success) {
    if (success) {
        handlePaymentSuccess();
    } else {
        handlePaymentFailure();
    }
}

// Attach the simulatePaymentResponse to a button for testing (remove this in production)
document.querySelector('.join-button').addEventListener('click', function(event) {
    event.preventDefault();
    simulatePaymentResponse(true); // Change to 'false' to simulate failure
});

// Your existing JavaScript code for form submission and payment handling
function selectTab(plan) {
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });

    const selectedTab = document.querySelector(`.tab-button[onclick="selectTab('${plan}')"]`);
    selectedTab.classList.add('active');

    let membershipType = document.getElementById('membershipType');
    let membershipAmount = document.getElementById('membershipAmount');
    let totalAmount = document.getElementById('totalAmount');
    let amount, total;

    switch (plan) {
        case 'monthly':
            amount = 2000;
            total = 2500;
            break;
        case 'quarterly':
            amount = 5000;
            total = 5500;
            break;
        case 'yearly':
            amount = 18000;
            total = 18500;
            break;
        default:
            amount = 0;
            total = 0;
    }

    membershipType.innerText = plan.charAt(0).toUpperCase() + plan.slice(1);
    membershipAmount.innerText = `PHP ${amount}.00`;
    totalAmount.innerText = `PHP ${total}.00`;

    // Set hidden input values
    document.getElementById('plan').value = plan;
    document.getElementById('amount').value = total;

    console.log(`Plan set to: ${plan}`);
    console.log(`Amount set to: ${total}`);
}

function makePayment(event) {
    event.preventDefault(); // Prevent the default form submission
    const paymentForm = document.getElementById('paymentForm');
    const plan = document.getElementById('plan').value;
    const amount = document.getElementById('amount').value;

    // Debugging lines
    console.log(`Submitting form with plan: ${plan} and amount: ${amount}`);

    // Check if the plan and amount are set
    if (plan && amount) {
        paymentForm.submit();
    } else {
        alert("Plan and amount are not set correctly.");
    }
}

document.querySelector('.join-button').addEventListener('click', makePayment);
selectTab('monthly');
