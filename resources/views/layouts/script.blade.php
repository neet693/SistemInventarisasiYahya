<script>
    new DataTable('#example');
    new DataTable('#activitylogs');
    new DataTable('#barangPerUnit');
    new DataTable('#perbaikanTable');
    new DataTable('#pemindahanTable');
    document.querySelectorAll('.random-color').forEach(element => {
        element.style.color = '#' + Math.floor(Math.random() * 16777215).toString(16);
    });
</script>
