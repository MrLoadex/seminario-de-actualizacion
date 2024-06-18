//totalidad de grupos
let teamsData = [];
// totalidad de las acciones
let actionsData = [];
// acciones del grupo seleccionado
let actualTeam_actionData = 
[
    { actionId: 10, actionName: 'Action 1' },
    { actionId: 20, actionName: 'Action 2' },
    { actionId: 30, actionName: 'Action 3' }
];
// getters
function getTeamName(teamID) {
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
function getActionName(actionID) {
    return new Promise((resolve, reject) => {
        // Convertir actionID a una cadena si no lo es
        if (actionID !== null && (typeof actionID === 'string' || typeof actionID === 'number')) {
            actionID = String(actionID).trim();
            if (actionID !== '') {
                fetch(`../procesos/Action/getActionById.php?id=${actionID}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta de la red');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            resolve("Sin Accion");
                        } else {
                            resolve(data.name);
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener datos de la Accion:', error);
                        resolve("Sin Accion");
                    });
            } else {
                console.warn('Advertencia: Debe ingresar un ID de Accion válido.');
                resolve("Sin Accion");
            }
        } else {
            console.warn('Advertencia: Debe ingresar un ID de Accion válido.');
            resolve("Sin Accion");
        }
    });
}

// Funciones de ejemplo para los botones (a completar según tu lógica)
function editActionTeamLink() {
    // Capturar el id del equipo
    const selectedTeamId = document.getElementById('team-select').value;
    
    const url = `./formularios/editTeamActionsLinks.html?teamId=${selectedTeamId}`;
    
    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 800;
    const left = window.screenX + (window.innerWidth / 2) - (width / 2);
    const top = window.screenY + (window.innerHeight / 2) - (height / 2);

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'EditTeamActionsLinkWindow', options);
}


function createAction() 
{
    const url = './formularios/createAction.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'CreateActionWindow', options);
}

function deleteAction() 
{
    const url = './formularios/deleteAction.html';

    // Dimensiones y posición de la ventana emergente (ajústalas según tus necesidades)
    const width = 600;
    const height = 400;
    const left = window.innerWidth / 2 - width / 2;
    const top = window.innerHeight / 2 - height / 2;

    // Opciones de la ventana emergente
    const options = `width=${width},height=${height},left=${left},top=${top},resizable=no,scrollbars=no`;

    // Abrir la ventana emergente
    window.open(url, 'DeleteActionWindow', options);
}

function refreshTitle_Table() 
{
    // Declaracion de variables
    let selectedTeamId;

    // Capturar el nombre del equipo
    const teamSelect = document.getElementById('team-select');
    const selectedTeamIndex = teamSelect.selectedIndex;
    const selectedTeam = teamSelect.options[selectedTeamIndex].text;
    
    // Capturar el id del equipo
    for (let i = 0; i < teamsData.length; i++) {
        if (teamsData[i].groupName == selectedTeam) {
            selectedTeamId = teamsData[i].groupId;
        }
    }

    // Actualizar la lista de acciones del equipo
    //////////////////////////////////////////////////////////////////////////////////////
    
    
    // Refrescar titulo
    const teamTitle = document.getElementById('team-title');
    teamTitle.textContent = selectedTeam;
    
    // Refrescar acciones
    const teamActionsTableBody = document.getElementById('team-actions-table').getElementsByTagName('tbody')[0];
    teamActionsTableBody.innerHTML = ''; // Eliminar el contenido actual de la tabla
    
    actualTeam_actionData.forEach(data => {
        const row = document.createElement('tr');
        const actionIdCell = document.createElement('td');
        const actionNameCell = document.createElement('td');

        actionIdCell.textContent = data.actionId;
        actionNameCell.textContent = data.actionName;

        row.appendChild(actionIdCell);
        row.appendChild(actionNameCell);

        teamActionsTableBody.appendChild(row);
    });
}

function refreshTeamsSelector() 
{
    const teamSelect = document.getElementById('team-select');
    teamSelect.innerHTML = '<option value="">Seleccione un grupo</option>'; // Limpiar el selector actual

    teamsData.forEach(team => {
        const option = document.createElement('option');
        option.value = team.id;
        option.textContent = team.name;
        teamSelect.appendChild(option);
    });
}

function refreshActionsTable() {
    const actionsTableBody = document.getElementById('actions-table').getElementsByTagName('tbody')[0];
    actionsTableBody.innerHTML = ''; // Limpiar el contenido actual de la tabla

    actionsData.forEach(action => {
        const row = document.createElement('tr');
        const actionIdCell = document.createElement('td');
        const actionNameCell = document.createElement('td');

        actionIdCell.textContent = action.id;
        actionNameCell.textContent = action.name;

        row.appendChild(actionIdCell);
        row.appendChild(actionNameCell);

        actionsTableBody.appendChild(row);
    });
}

function refreshTeamsData() 
{
    // Limpiar la lista antes de llenarla
    teamsData = [];

    // Realizar la solicitud para obtener todos los equipos
    fetch('../procesos/Team/getAllTeams.php')
        .then(response => response.json())
        .then(data => {
            // Verificar si se recibieron datos
            if (Array.isArray(data)) {
                // Crear una lista de promesas para todas las operaciones de procesar equipos
                let promises = data.map(team => {
                    return new Promise((resolve, reject) => {
                        const current_team = { id: parseInt(team.ID), name: team.name };
                        teamsData.push(current_team);
                        resolve();
                    });
                });

                // Esperar a que todas las promesas se resuelvan
                Promise.all(promises).then(() => {
                    // Llamar a refreshTeamsSelector después de completar el fetch y procesar los datos
                    refreshTeamsSelector();
                });
            } else {
                console.error('Error: No se recibieron datos válidos.');
            }
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}

function refreshActionData()
{
    // Limpiar la lista antes de llenarla
    actionsData = [];

    // Realizar la solicitud para obtener todos los equipos
    fetch('../procesos/Action/getAllActions.php')
        .then(response => response.json())
        .then(data => {
            // Verificar si se recibieron datos
            if (Array.isArray(data)) {
                // Crear una lista de promesas para todas las operaciones de procesar equipos
                let promises = data.map(action => {
                    return new Promise((resolve, reject) => {
                        const current_action = { id: parseInt(action.ID), name: action.name };
                        actionsData.push(current_action);
                        resolve();
                    });
                });

                // Esperar a que todas las promesas se resuelvan
                Promise.all(promises).then(() => {
                    // Llamar a refreshActionsTable después de completar el fetch y procesar los datos
                    refreshActionsTable();
                });
            } else {
                console.error('Error: No se recibieron datos válidos.');
            }
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}

function refreshActualTeam_actionData(selectedTeamId) {
    // Limpiar la lista antes de usarla
    actualTeam_actionData = [];

    // Realizar la solicitud para obtener todos los vínculos de equipos con acciones
    fetch(`../procesos/TeamActionLink/getTeamActionsByTeamId.php?teamId=${selectedTeamId}`)
        .then(response => response.json())
        .then(data => {
            // Verificar si se recibieron datos
            if (Array.isArray(data)) {
                // Crear una lista de promesas para todas las solicitudes de nombres de acciones
                let promises = data.map(team_action => {
                    return getActionName(team_action.ID_action).then(actionName => {
                        // Añadir la acción a actualTeam_actionData
                        actualTeam_actionData.push({ actionId: team_action.ID_action, actionName: actionName });
                    });
                });

                // Esperar a que todas las promesas se resuelvan
                Promise.all(promises).then(() => {
                    // Refrescar la tabla de acciones del equipo
                    const teamActionsTableBody = document.getElementById('team-actions-table').getElementsByTagName('tbody')[0];
                    teamActionsTableBody.innerHTML = ''; // Limpiar el contenido actual de la tabla

                    actualTeam_actionData.forEach(data => {
                        const row = document.createElement('tr');
                        const actionIdCell = document.createElement('td');
                        const actionNameCell = document.createElement('td');

                        actionIdCell.textContent = data.actionId;
                        actionNameCell.textContent = data.actionName;

                        row.appendChild(actionIdCell);
                        row.appendChild(actionNameCell);

                        teamActionsTableBody.appendChild(row);
                    });
                });
            } else {
                console.error('Error: No se recibieron datos válidos.');
            }
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}

// Llamar a refreshTeamsData() para inicializar la tabla con las acciones
refreshTeamsData();
// Llamar a refreshActionData() para inicializar el selector con los equipos
refreshActionData();
// Llamar a refreshTeam_ActionData() inicialmente para llenar la tabla con el primer equipo seleccionado
// refreshActualTeam_actionData();

// Cambio dinámico del título de la tabla
document.getElementById('team-select').addEventListener('change', (event) => {
    // Actualizar las acciones del team
    const selectedTeamId = event.target.value;
    refreshActualTeam_actionData(selectedTeamId);
    // Cambiar el titulo
    document.getElementById('team-title').innerHTML = event.target.selectedOptions[0].textContent;
});

