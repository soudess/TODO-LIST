window.onload = function () {
  chargerPage();
};


document.getElementById('TodoForm').addEventListener('submit', function (e) {
  e.preventDefault();
  let todo = document.getElementById('todo').value.trim();

  if (todo === '') {
alert("Veuillez saisir une tâche !");
return;
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajouter.php", true);
  xhr.onreadystatechange = function () {
if (xhr.readyState == 4 && xhr.status == 200) {
  document.getElementById('todo_list').innerHTML = xhr.responseText;
  document.getElementById('todo').value = "";
}
  };

  xhr.send("todo=" + encodeURIComponent(todo));
});


function chargerPage() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "ajouter.php", true);

  xhr.onreadystatechange = function () {
if (xhr.readyState == 4 && xhr.status == 200) {
  document.getElementById('todo_list').innerHTML = xhr.responseText;
}
  };

  xhr.send();
}
function deleteTodo(id) {
if (!confirm("Voulez-vous vraiment supprimer cette tâche ?")) return;

const xhr = new XMLHttpRequest();
xhr.open("GET", "supprimer.php?id=" + id, true);
xhr.onreadystatechange = function () {
if (xhr.readyState === 4 && xhr.status === 200) {
const tache = document.getElementById("tache-" + id);
if (tache) tache.remove();
}
}; 
xhr.send();
}
function updateTodo(id) {
    const newTodo = prompt("Nouvelle tâche ......");
    if (!newTodo) return; 

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "modification.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const tache = document.getElementById("tache-" + id);
            if (tache) {
                tache.textContent = newTodo;
            }
        }
    };
    xhr.send("id=" + encodeURIComponent(id) + "&newTodo=" + encodeURIComponent(newTodo));
}

function exporterXML() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "exporte.php", true);

  xhr.onreadystatechange = function () {
if (xhr.readyState == 4 && xhr.status == 200) {
  document.getElementById('todo_list').innerHTML = xhr.responseText;
}
  };

  xhr.send();
}
function import_xml() {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "import_xml.php", true);

  xhr.onreadystatechange = function () {
if (xhr.readyState == 4 && xhr.status == 200) {
  document.getElementById('todo_list').innerHTML = xhr.responseText;
}
  };

  xhr.send();
}