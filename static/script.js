let taskEditId;

window.onload = () => {
    let queryParams = new URLSearchParams(window.location.search);
    let order_by = queryParams.get('order-by')
    let sort_by = queryParams.get('sort-by')
    let sort_options = Array.from(document.getElementById('sort-by').options)
    let order_options = Array.from(document.getElementById('order-by').options)
    for(let i = 0; i < sort_options.length; i++){
        if (sort_options[i].text === sort_by){
            document.getElementById('sort-by').selectedIndex = i
        }
    }
    for(let i = 0; i < order_options.length; i++){
        if (order_options[i].text === order_by){
            document.getElementById('order-by').selectedIndex = i
        }
    }
}

const closeEditTask = taskId => {
    if(typeof taskId !== 'number')
        return null
    let button = document.getElementById('button-' + taskId)
    let editField = document.getElementById('edit-field-' + taskId)
    editField.innerHTML = ""
    let doneField = document.getElementById('done-field-' + taskId)
    doneField.innerHTML = ""
    button.setAttribute('onclick', 'editTask(' + taskId + ')')
    button.innerText = 'Edit'
    taskEditId = undefined
}

const saveTask = taskId => {
    let xhr = new XMLHttpRequest();
    let text = document.getElementById("edit-text-" + taskId).value
    let done = document.getElementById("done-box-" + taskId).checked
    let body = 'id=' + encodeURIComponent(taskId) +
        '&goal_text=' + encodeURIComponent(text) +
        '&done=' + encodeURIComponent(done)
    xhr.open("POST", '/index.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

    closeEditTask(taskId)
    xhr.send(body)
    location.reload()
}

const editTask = taskId => {
    closeEditTask(taskEditId)
    taskEditId = taskId
    let card_text = document.getElementById('text-' + taskId)
    let button = document.getElementById('button-' + taskId)
    let tag = "<div class='form-group' id='edit-field-" + taskId + "'>\n" +
        "    <label for='exampleFormControlTextarea1'>Change to</label>\n" +
        "    <textarea class='form-control' name='goal_text' id='edit-text-" + taskId + "' rows='3'></textarea>\n" +
        "</div>"
    let done_box = "<div class=\"input-group mb-3 borber-0\" id=\"done-field-" + taskId + "\">\n" +
        "  <div class=\"input-group-prepend\">\n" +
        "    <div class=\"input-group-text\">\n" +
        "      <input type=\"checkbox\" id='done-box-" + taskId + "'>\n" +
        "    </div>\n" +
        "  </div>\n" +
        "  <p class='form-control'>Done</p>\n" +
        "</div>"
    card_text.insertAdjacentHTML("afterend", done_box)
    card_text.insertAdjacentHTML("afterend", tag)
    
    button.innerText = "Save" 
    button.setAttribute('onclick', 'saveTask(' + taskId + ')')
}

const sortTasks = () => {
    let sort_by = document.getElementById('sort-by').value
    let order_by = document.getElementById('order-by').value
    
    let queryParams = new URLSearchParams(window.location.search);

    queryParams.set('sort-by', sort_by)

    history.pushState(null, null, "?"+queryParams.toString());
    location.reload()
}

const orderTasks = () => {
    let sort_by = document.getElementById('sort-by').value
    let order_by = document.getElementById('order-by').value
    
    let queryParams = new URLSearchParams(window.location.search);
    
    queryParams.set('order-by', order_by)

    history.pushState(null, null, "?"+queryParams.toString());
    location.reload()
}

const pageClick = pageNumber => {
    let queryParams = new URLSearchParams(window.location.search);
    
    queryParams.set('page', pageNumber)

    history.pushState(null, null, "?"+queryParams.toString());
    location.reload()
}