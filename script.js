document.addEventListener('DOMContentLoaded', () => {
    const computerSelect = document.getElementById('computer');
    const maintenanceForm = document.getElementById('maintenanceForm');
    const scheduleIdInput = document.getElementById('scheduleId');
    const fetchScheduleButton = document.getElementById('fetchSchedule');
    const updateForm = document.getElementById('updateForm');
    const updateEmployeeNameInput = document.getElementById('updateEmployeeName');
    const updateDepartmentInput = document.getElementById('updateDepartment');
    const updateDateInput = document.getElementById('updateDate');
    const updateTimeInput = document.getElementById('updateTime');
    const userIdInput = document.getElementById('userId');
    const checkInfoButton = document.getElementById('checkInfo');
    const infoDisplay = document.getElementById('infoDisplay');
    const reportForm = document.getElementById('reportForm');

    // Populating computer selection
    for (let i = 1; i <= 60; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = `Computadora ${i}`;
        computerSelect.appendChild(option);
    }

    // Handle maintenance form submission
    maintenanceForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = new FormData(maintenanceForm);
        try {
            const response = await fetch('insertar_registro.php', {
                method: 'POST',
                body: data
            });
            const result = await response.text();
            alert(result);
        } catch (error) {
            console.error('Error:', error);
            alert('Error al enviar el formulario de mantenimiento.');
        }
    });

    // Handle clear button for maintenance form
    document.getElementById('clearMaintenanceForm').addEventListener('click', () => {
        maintenanceForm.reset();
    });

    // Fetch and populate update form
    fetchScheduleButton.addEventListener('click', async () => {
        const scheduleId = scheduleIdInput.value;
        try {
            const response = await fetch('fetch_schedule.php?id=' + encodeURIComponent(scheduleId));
            const result = await response.json();
            if (result) {
                updateEmployeeNameInput.value = result.employee_name;
                updateDepartmentInput.value = result.department;
                updateDateInput.value = result.maintenance_date;
                updateTimeInput.value = result.maintenance_time;
                updateForm.style.display = 'block';
            } else {
                alert('No se encontró la programación.');
                updateForm.style.display = 'none';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al buscar la programación.');
        }
    });

    // Handle update form submission
    updateForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = new FormData(updateForm);
        data.append('id', scheduleIdInput.value);
        try {
            const response = await fetch('actualizar_registro.php', {
                method: 'POST',
                body: data
            });
            const result = await response.text();
            alert(result);
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar la programación.');
        }
    });

    // Handle clear button for update form
    document.getElementById('clearUpdateForm').addEventListener('click', () => {
        updateForm.reset();
        updateForm.style.display = 'none';
    });

    // Check user info
    checkInfoButton.addEventListener('click', async () => {
        const userId = userIdInput.value;
        try {
            const response = await fetch('check_info.php?userId=' + encodeURIComponent(userId));
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();
            if (result) {
                infoDisplay.innerHTML = `
                    Nombre del Empleado: ${result.employee_name}<br>
                    Área: ${result.department}<br>
                    Fecha Programada: ${result.maintenance_date}<br>
                    Hora: ${result.maintenance_time}`;
            } else {
                infoDisplay.innerHTML = 'No se encontró información para este usuario.';
            }
        } catch (error) {
            console.error('Error:', error);
            infoDisplay.innerHTML = 'Error al consultar la información del usuario.';
        }
    });

    // Handle clear button for user info
    document.getElementById('clearUserInfo').addEventListener('click', () => {
        userIdInput.value = '';
        infoDisplay.innerHTML = '';
    });

    // Handle report issue form submission
    reportForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = new FormData(reportForm);
        try {
            const response = await fetch('reportar_inconveniente.php', {
                method: 'POST',
                body: data
            });
            const result = await response.text();
            alert(result);
        } catch (error) {
            console.error('Error:', error);
            alert('Error al enviar el reporte.');
        }
    });

    // Handle clear button for report form
    document.getElementById('clearReportForm').addEventListener('click', () => {
        reportForm.reset();
    });
});
