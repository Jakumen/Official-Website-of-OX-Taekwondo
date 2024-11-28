// script.js
document.addEventListener('DOMContentLoaded', function () {
    fetch('fetchAnalytics.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-users').innerText = data.total_users;
            const activitiesList = document.getElementById('recent-activities');
            activitiesList.innerHTML = '';
            data.recent_activities.forEach(activity => {
                const li = document.createElement('li');
                li.innerText = activity;
                activitiesList.appendChild(li);
            });
        })
        .catch(error => console.error('Error fetching analytics:', error));
});
