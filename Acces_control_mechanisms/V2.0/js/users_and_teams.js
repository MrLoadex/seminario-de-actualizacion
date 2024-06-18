
const userData = [
    { id: 1, name: 'Juan Pérez', team1: false, team2: true, team3: false },
    { id: 2, name: 'Ana Gomez', team1: true, team2: false, team3: true }
];
const teamData = [
    { id: 1, name: 'Team1' },
    { id: 2, name: 'Team2' },
    { id: 3, name: 'Team3' },
    { id: 4, name: 'Team4' },
];

// Asignar el evento de clic a los botones
document.getElementById('createUserButton').addEventListener('click', createUser);
document.getElementById('editUserButton').addEventListener('click', editUser);
document.getElementById('deleteUserButton').addEventListener('click', deleteUser);
document.getElementById('createTeamButton').addEventListener('click', createTeam);
document.getElementById('editTeamButton').addEventListener('click', editTeam);
document.getElementById('deleteTeamButton').addEventListener('click', deleteTeam);
document.getElementById('editUserTeamLinksButton').addEventListener('click', editUserTeamLinks);



refreshTitle_Table();

// Función para refrescar la tabla
function refreshTitle_Table() {
    const table = document.getElementById('usersTeamTable');
    const tableHead = table.querySelector('thead');
    const tableBody = table.querySelector('tbody');

    // Limpiar el contenido existente
    tableHead.innerHTML = '';
    tableBody.innerHTML = '';

    // Crear encabezado de la tabla
    const headerRow = document.createElement('tr');
    const headers = ['Id', 'Name', ...teamData.map(team => `${team.id} ${team.name}`)];
    headers.forEach(headerText => {
        const header = document.createElement('th');
        header.textContent = headerText;
        headerRow.appendChild(header);
    });
    tableHead.appendChild(headerRow);

    // Crear filas de la tabla
    userData.forEach(user => {
        const row = document.createElement('tr');

        // Crear celdas de ID y nombre
        const cellId = document.createElement('td');
        cellId.textContent = user.id;
        row.appendChild(cellId);

        const cellName = document.createElement('td');
        cellName.textContent = user.name;
        row.appendChild(cellName);

        // Crear celdas para cada equipo
        teamData.forEach(team => {
            const cell = document.createElement('td');
            const teamKey = `team${team.id}`;
            cell.textContent = user[teamKey] ? '✔' : 'X';
            row.appendChild(cell);
        });

        tableBody.appendChild(row);
    });
}

function createUser() {
    const url = './formularios/createUser.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'CreateUserWindow', options);
}

    
function editUser()
{
    const url = './formularios/editUser.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'EditUserWindow', options);
}

function deleteUser()
{
    const url = './formularios/deleteUser.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'DeleteUserWindow', options);
}

function createTeam()
{
    const url = './formularios/createTeam.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'CreateTeamWindow', options);
}

function editTeam()
{
    const url = './formularios/editTeam.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'EditTeamWindow', options);
}

function deleteTeam()
{
    const url = './formularios/deleteTeam.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'DeleteTeamWindow', options);
}

function editUserTeamLinks()
{
    const url = './formularios/editUserTeamLinks.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'EditUserTeamLinksWindow', options);
}


