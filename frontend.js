function openAddProjectModal() {
    document.getElementById('addProjectModal').style.display = 'block';
  }
  function addProject() {
    const projectName = document.getElementById('projectName').value;
    const projectList = document.getElementById('projectList');
    const listItem = document.createElement('li');
    listItem.innerHTML = `<a href="task.html">${projectName}</a>`;
    projectList.appendChild(listItem);
  
    document.getElementById('addProjectModal').style.display = 'none';
  }
  function openAddTaskModal() {
    document.getElementById('addTaskModal').style.display = 'block';
  }
  
  function addTask() {
    const taskName = document.getElementById('taskName').value;
    const assignedPerson = document.getElementById('assignedPerson').value;
    const taskStatus = document.getElementById('taskStatus').value;
    const taskList = document.getElementById('taskList');
    const listItem = document.createElement('li');
    listItem.innerHTML = `<b>${taskName}</b> - Assigned to: ${assignedPerson} - Status: ${taskStatus}`;
    taskList.appendChild(listItem);
  
    document.getElementById('addTaskModal').style.display = 'none';
  }
  