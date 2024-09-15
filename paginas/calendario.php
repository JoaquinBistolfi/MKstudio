<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Interactivo</title>
    <link rel="stylesheet" href="../css/calendario.css">
</head>

<body>
    <div class="calendar">
        <div class="calendar-header">
            <button onclick="prevMonth()">Anterior</button>
            <div id="monthYear"></div>
            <button onclick="nextMonth()">Siguiente</button>
        </div>
        <div class="calendar-body">
            <table class="calendar-table">
                <thead>
                    <tr>
                        <th>Dom</th>
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Mié</th>
                        <th>Jue</th>
                        <th>Vie</th>
                        <th>Sáb</th>
                    </tr>
                </thead>
                <tbody id="calendarBody"></tbody>
            </table>
        </div>
    </div>

    <script>
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth();

        function generateCalendar(year, month) {
            const calendarBody = document.getElementById('calendarBody');
            const monthYear = document.getElementById('monthYear');

            const months = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];

            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            monthYear.textContent = `${months[month]} ${year}`;
            calendarBody.innerHTML = '';

            let date = 1;

            for (let i = 0; i < 6; i++) {
                const row = document.createElement('tr');

                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement('td');
                    if (i === 0 && j < firstDay) {
                        cell.textContent = '';
                    } else if (date > lastDate) {
                        cell.textContent = '';
                    } else {
                        cell.textContent = date;
                        cell.addEventListener('click', () => addImageToCell(cell));
                        date++;
                    }
                    row.appendChild(cell);
                }

                calendarBody.appendChild(row);
            }
        }

        function prevMonth() {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear--;
            } else {
                currentMonth--;
            }
            generateCalendar(currentYear, currentMonth);
        }

        function nextMonth() {
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear++;
            } else {
                currentMonth++;
            }
            generateCalendar(currentYear, currentMonth);
        }

        function addImageToCell(cell) {
            if (!cell.querySelector('img')) {
                const img = document.createElement('img');
                img.src = 'http://localhost/MKstudio/imagenes/vaquita.jpeg'; // URL de la imagen pequeña
                cell.appendChild(img);
            }
        }

        generateCalendar(currentYear, currentMonth);
    </script>
    </body>

</html>
