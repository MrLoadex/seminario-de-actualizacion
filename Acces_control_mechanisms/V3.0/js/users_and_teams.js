
let usersTeamsData = [];
let teamsData = [];

// Asignar el evento de clic a los botones
document.getElementById('createUserButton').addEventListener('click', createUser);
document.getElementById('editUserButton').addEventListener('click', editUser);
document.getElementById('deleteUserButton').addEventListener('click', deleteUser);
document.getElementById('createTeamButton').addEventListener('click', createTeam);
document.getElementById('editTeamButton').addEventListener('click', editTeam);
document.getElementById('deleteTeamButton').addEventListener('click', deleteTeam);
document.getElementById('editUserTeamLinksButton').addEventListener('click', editUserTeamLinks);
document.getElementById('refreshButton').addEventListener('click', function() {
    refreshTeamsData();
    refreshUsersTeamsData();
});



refreshTeamsData();
refreshUsersTeamsData();
function refreshTeamsData() {
    // Limpiar la lista antes de llenarla
    teamsData = [];

    // Realizar la solicitud para obtener todos los equipos
    fetch('../procesos/Team/getAllTeams.php')
        .then(response => response.json())
        .then(data => {
            // Verificar si se recibieron datos
            if (Array.isArray(data)) {
                // Iterar sobre los datos y agregar a teamData
                data.forEach(team => {
                    const current_team = { id: parseInt(team.ID), name: team.name };
                    teamsData.push(current_team);
                });

                // Llamar a refreshTitle_MainTable después de completar el fetch
                refreshTitle_MainTable();
            } else {
                console.error('Error: No se recibieron datos válidos.');
            }
        })
        .catch(error => console.error('Error al cargar los datos:', error));
} 

function refreshUsersTeamsData() {
    // Limpiar la lista antes de usarla
    usersTeamsData = [];

    // Realizar la solicitud para obtener todos los vínculos de usuarios con equipos
    fetch('../procesos/UserTeamLink/getAllUsersTeams.php')
        .then(response => response.json())
        .then(data => {
            // Verificar si se recibieron datos
            if (Array.isArray(data)) {
                // Crear una lista de promesas para todas las solicitudes de nombres de usuario y equipos
                let promises = data.map(user_team => {
                    return Promise.all([
                        getUserName(user_team.ID_user),
                        getActionName(user_team.ID_team)
                    ])
                    .then(([userName, teamName]) => {
                        // Buscar si el usuario ya está en usersTeamsData
                        let user = usersTeamsData.find(user => user.id === user_team.ID_user);

                        if (user) {
                            // Si el usuario existe, agregar/actualizar el equipo
                            user[teamName] = true;
                        } else {
                            // Si el usuario no existe, crear un nuevo objeto de usuario
                            let newUser = { id: user_team.ID_user, name: userName, [teamName]: true };
                            usersTeamsData.push(newUser);
                        }
                    });
                });

                // Esperar a que todas las promesas se resuelvan
                Promise.all(promises).then(() => {
                    // Refrescar los usuarios sin equipo
                    refreshUsersOutGroup();
                });
            } else {
                console.error('Error: No se recibieron datos válidos.');
            }
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}


function refreshUsersOutGroup()
{

    // Realizar la solicitud para obtener todos los equipos
    fetch('../procesos/User/getAllUsers.php')
        .then(response => response.json())
        .then(data => {
            // Verificar si se recibieron datos
            if (Array.isArray(data)) {
                // Iterar sobre los datos y agregar a teamData
                data.forEach(user => {
                    let userExistente = usersTeamsData.find(userBuscado => userBuscado.id === user.ID);
                    if(userExistente)
                    {
                        // console.log('el usuario: ' + user.name + ' ya existe.');
                    }
                    else
                    {
                        const current_user = { id: user.ID, name: user.name };
                        usersTeamsData.push(current_user);
                    }
                    
                });
                // Actualizar los usuarios disponibles
                refreshTitle_MainTable();
            } else {
                console.error('Error: No se recibieron datos válidos.');
            }
            
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}  
// Función para refrescar la tabla
function refreshTitle_MainTable() {
    const table = document.getElementById('usersTeamTable');
    const tableHead = table.querySelector('thead');
    const tableBody = table.querySelector('tbody');

    // Limpiar el contenido existente
    tableHead.innerHTML = '';
    tableBody.innerHTML = '';

    // Crear encabezado de la tabla
    const headerRow = document.createElement('tr');
    const headers = ['Id', 'Name', ...teamsData.map(team => `${team.id} ${team.name}`)];
    headers.forEach(headerText => {
        const header = document.createElement('th');
        header.textContent = headerText;
        headerRow.appendChild(header);
    });
    tableHead.appendChild(headerRow);

    // Crear filas de la tabla
    usersTeamsData.forEach(user => {
        const row = document.createElement('tr');

        // Crear celdas de ID y nombre
        const cellId = document.createElement('td');
        cellId.textContent = user.id;
        row.appendChild(cellId);

        const cellName = document.createElement('td');
        cellName.textContent = user.name;
        row.appendChild(cellName);

        // Crear celdas para cada equipo
        teamsData.forEach(team => {
            const cell = document.createElement('td');
            const teamKey = `${team.name}`;
            cell.textContent = user[teamKey] ? '✅' : '❌';
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
    const height = 600;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'EditUserTeamLinksWindow', options);
}

// Geters
function getUserName(userID) {
    return new Promise((resolve, reject) => {
        if (typeof userID === 'string' && userID.trim() !== '') {
            fetch(`../procesos/User/getUserById.php?id=${userID}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la red');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        resolve("Sin Usuario");
                    } else {
                        resolve(data.name);
                    }
                })
                .catch(error => {
                    console.error('Error al obtener datos del usuario:', error);
                    resolve("Sin Usuario");
                });
        } else {
            const errorMsg = 'Error: Debe ingresar un ID de usuario válido.';
            console.error(errorMsg);
            resolve("Sin Usuario");
        }
    });
}

function getActionName(teamID) {
    return new Promise((resolve, reject) => {
        if (teamID !== null && teamID.trim() !== '') {
            fetch(`../procesos/Team/getTeamById.php?id=${teamID}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la red');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        resolve("Sin Equipo");
                    } else {
                        resolve(data.name);
                    }
                })
                .catch(error => {
                    console.error('Error al obtener datos del equipo:', error);
                    resolve("Sin Equipo");
                });
        } else {
            console.warn('Advertencia: Debe ingresar un ID de equipo válido.');
            resolve("Sin Equipo");
        }
    });
}
