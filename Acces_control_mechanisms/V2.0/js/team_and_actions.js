//totalidad de grupos
let teams = 
[
    { groupId: 11, groupName: 'Group 1' },
    { groupId: 22, groupName: 'Group 2' },
    { groupId: 33, groupName: 'Group 3' },
];
// totalidad de las acciones
let actions = 
[
    { actionId: 101, actionName: 'Action 1' },
    { actionId: 202, actionName: 'Action 2' },
    { actionId: 303, actionName: 'Action 3' },
];
// acciones del grupo seleccionado
let actualTeam_actionData = 
[
    { actionId: 10, actionName: 'Action 1' },
    { actionId: 20, actionName: 'Action 2' },
    { actionId: 30, actionName: 'Action 3' }
];
// Funciones de ejemplo para los botones (a completar según tu lógica)
function editActionTeamLink() {
    console.log('Editando Vinculacion de equipo y accion');
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
    for (let i = 0; i < teams.length; i++) {
        if (teams[i].groupName == selectedTeam) {
            selectedTeamId = teams[i].groupId;
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
    teamSelect.innerHTML = ''; // Limpiar el selector actual

    teams.forEach(team => {
        const option = document.createElement('option');
        option.value = team.groupId;
        option.textContent = team.groupName;
        teamSelect.appendChild(option);
    });
}

function refreshActionsTable() {
    const actionsTableBody = document.getElementById('actions-table').getElementsByTagName('tbody')[0];
    actionsTableBody.innerHTML = ''; // Limpiar el contenido actual de la tabla

    actions.forEach(action => {
        const row = document.createElement('tr');
        const actionIdCell = document.createElement('td');
        const actionNameCell = document.createElement('td');

        actionIdCell.textContent = action.actionId;
        actionNameCell.textContent = action.actionName;

        row.appendChild(actionIdCell);
        row.appendChild(actionNameCell);

        actionsTableBody.appendChild(row);
    });
}







// Llamar a refreshActionsTable() para inicializar la tabla con las acciones
refreshActionsTable();
// Llamar a refreshSelector() para inicializar el selector con los equipos
refreshTeamsSelector();
// Llamar a refreshTable() inicialmente para llenar la tabla con el primer equipo seleccionado
refreshTitle_Table();

// Cambio dinámico del título de la tabla
document.getElementById('team-select').addEventListener('change', refreshTitle_Table);