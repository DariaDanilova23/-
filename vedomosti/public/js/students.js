Math.clamp = (v, a, b) => Math.max(a, Math.min(v, b))
Set.prototype.equals = function(a){
    return a.size === this.size && [...a].every(value => this.has(value))
}
Node.prototype.insertAfter = function(newNode){
    return this.parentNode.insertBefore(newNode, this.nextSibling)
}
Node.prototype.getElementsByName = function(name){
    return this.querySelectorAll(`[name="${name}"]`)
}

class Entry {
    constructor(id, FIO, address, phone, email, ReportCardNo, deleted = false){
        if(typeof id === 'object'){
            Object.assign(this, id)
            return
        }
        Object.assign(this, { id, FIO, address, phone, email, ReportCardNo, deleted })
    }
    read(element = this.element){
        for(let name of [ 'id', 'FIO', 'address', 'phone', 'email', 'ReportCardNo']){
            let input = element.getElementsByName(name)[0]
            if(input){
                this[name] = input.value
            }
        }
        return this
    }
    write(element = this.element){
        for(let name of [ 'id', 'FIO', 'address', 'phone', 'email', 'ReportCardNo' ]){
            let input = element.getElementsByName(name)[0]
            if(input){
                input.value = this[name]
            }
        }
        return this
    }
    equals(entry){
        this.FIO === entry.FIO
        && this.address === entry.address
        && this.phone === entry.phone
        && this.email === entry.email
        && this.ReportCardNo === entry.ReportCardNo
    }
}
class FieldChange {
    constructor(target){
        this.type = 'change'
        this.target = target
        this.value = target.value
        this.oldValue = target.oldValue
    }
    equals(change){
        return change.type === this.type
            && change.target === this.target
            && change.value === this.value
            && change.oldValue === this.oldValue
    }
    redo(){
        this.target.value = this.value
        this.target.closest('.entry').entry[this.target.name] = this.value
    }
    undo(){
        this.target.value = this.oldValue
        this.target.closest('.entry').entry[this.target.name] = this.oldValue
    }
}
class DeleteChange {
    constructor(ids){
        this.type = 'delete'
        this.ids = ids
    }
    equals(change){
        return false
        //return change.type === this.type
        //    && change.entry.equals(this.entry)
    }
    redo(){
        forEachId(this.ids, entry => {
            entry.element.classList.add('deleted-entry')
            entry.deleted = true
        })
    }
    undo(){
        forEachId(this.ids, entry => {
            entry.element.classList.remove('deleted-entry')
            entry.deleted = false
        })
    }
}
class AddChange {
    constructor(entry){
        this.type = 'add'
        this.entry = entry
    }
    equals(change){
        return false
        //return change.type === this.type
        //    && change.entry.equals(this.entry)
    }
    redo(){
        this.entry.element.classList.remove('deleted-entry')
        this.entry.deleted = false
    }
    undo(){
        this.entry.element.classList.add('deleted-entry')
        this.entry.deleted = true
    }
}
function readEnties(html){
    let ret = {}
    for(let entryElement of html.querySelectorAll('.entry')){
        let entry = new Entry()
        entry.element = entryElement
        entryElement.entry = entry
        entry.read(entryElement)
        ret[entry.id] = entry
    }
    return ret
}
var initialTable = initialTable || readEnties(document)
let currentTable = copyTable(initialTable)
function copyTable(table){
    let ret = {}
    for(let [k, v] in Object.values(table))
        ret[k] = new Entry(v)
    return ret
}
let entryElementTemplate = document.querySelector('#entry-template').content.firstElementChild
let newEntryForm = document.querySelector('#new-entry')
let pageContent = document.querySelector('#content')
let addedEntries = 0
function add(){
    let entry = new Entry(-++addedEntries)
    entry.read(newEntryForm)
    currentTable[entry.id] = entry

    let entryElement = entryElementTemplate.cloneNode(true)
    entry.element = entryElement
    entryElement.entry = entry
    newEntryForm.insertAfter(entryElement)
    entry.write(entryElement)
    listen(entryElement)

    let change = new AddChange(entry)
    change.redo()
    push(change)
    updateButtons()
}

let history = []
let historyOffset = -1 // nothing to redo
function undo(){
    historyOffset++
    if(historyOffset <= -1 || historyOffset >= history.length){
        historyOffset = Math.clamp(historyOffset, -1, history.length)
        return
    }
    let change = history[history.length - historyOffset - 1]
    change.undo()
    updateButtons()
}
function redo(){
    if(historyOffset <= -1 || historyOffset >= history.length){
        historyOffset = Math.clamp(historyOffset, -1, history.length)
        return
    }
    let change = history[history.length - historyOffset - 1]
    change.redo()
    historyOffset--
    updateButtons()
}
function push(change){
    if(historyOffset > -1 && historyOffset < history.length){
        let lastChange = history[history.length - historyOffset - 1]
        if(lastChange.equals(change)){
            historyOffset--
            return
        } else {
            history.splice(history.length - historyOffset - 1, historyOffset + 1)
            historyOffset = -1;
        }
    }
    history.push(change)
}
function onFieldFocus(e){
    e.target.oldValue = e.target.value
}
function onFieldInput(e){
    let change
    if(history.length > 0 && historyOffset <= -1){
        let lastChange = history[history.length - 1]
        if(
            lastChange.type === 'change'
            && lastChange.target === e.target
            && lastChange.oldValue === e.target.oldValue
        ){
            change = lastChange
            change.value = e.target.value
        }
    }
    if(!change){
        change = new FieldChange(e.target)
        push(change)
        updateButtons()
    }
    change.redo()
    return true
}
let undoBtn = document.querySelector('#undo-btn')
let redoBtn = document.querySelector('#redo-btn')
let saveBtn = document.querySelector('#save-btn')
let removeBtn = document.querySelector('#remove-btn')
let deselectBtn = document.querySelector('#deselect-btn')
let selection = new Set()
function deselect(){
    selection.clear()
    for(let checkbox of document.querySelectorAll('.entry-checkbox')){
        checkbox.checked = false
    }
    updateButtons()
}
function forEachId(ids, func){
    for(let entry of Object.values(currentTable)){
        if(ids.has(entry.id)){
            func(entry)
        }
    }
}
function remove(){
    let change = new DeleteChange(new Set(selection))
    change.redo()
    push(change)
    deselect()
}
updateButtons()
function updateButtons(disable = false){
    redoBtn.disabled = disable || historyOffset <= -1
    undoBtn.disabled = disable || (historyOffset + 1) >= history.length
    saveBtn.disabled = disable || undoBtn.disabled
    removeBtn.disabled = disable || selection.size === 0
    removeBtn.innerText = disable || `Удалить ${selection.size}`
    deselectBtn.disabled = disable || selection.size === 0
}
listen(document)
function listen(element){
    for(let field of element.querySelectorAll('.entry-field')){
        field.onfocus = onFieldFocus
        field.oninput = onFieldInput
    }
    for(let checkbox of element.querySelectorAll('.entry-checkbox')){
        checkbox.onchange = onCheckboxChange
    }
}
function onCheckboxChange(e){
    let id = parseInt(e.target.closest('.entry').querySelector('.entry-id').value)
    if(e.target.checked)
        selection.add(id)
    else
        selection.delete(id)
    updateButtons()
}

async function save(){
    updateButtons(true)

    let changed = []
    let added = []
    for(let [k, currentV] of Object.entries(currentTable)){
        if(!(k in initialTable) && !currentV.deleted){
            added.push(currentV)
        }
    }
    let removed = []
    for(let [k, initialV] of Object.entries(initialTable)){
        let currentV = currentTable[k]
        if(!(k in currentTable) || currentV.deleted){
            removed.push(k)
            continue
        }
       diff = currentV
        if(Object.keys(diff).length > 0)
            changed.push(diff)
    }

    let headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
    let requests = []
    for(let id of removed){
        requests.push(
            fetch(`student/${id}`, {
                method: 'DELETE', headers, redirect: 'manual',
            })
        )
    }
    for(let entry of added){
        requests.push(
            fetch(`student`, {
                method: 'POST', headers, redirect: 'manual',
                body: JSON.stringify({
                    'FIO': entry.FIO,
                    'Address': entry.address,
                    'PhoneNo': entry.phone,
                    'email': entry.email,
                    'ReportCardNo': parseFloat(entry.ReportCardNo)
                })
            })
        )
    }
    for(let diff of changed){
        requests.push(
            fetch(`student/${id}`, {
                method: 'PUT', headers, redirect: 'manual',
                //body: JSON.stringify(diff)
                body: JSON.stringify({
                    'FIO': diff.FIO,
                    'Address': diff.address,
                    'PhoneNo': diff.phone,
                    'email': entry.email,
                    'ReportCardNo':  parseFloat(entry.ReportCardNo)
                })
            })
        )
    }

    //TODO: handle errors
    await Promise.all(requests)

    let response = await fetch(`student`, {
        method: 'GET', headers, redirect: 'manual',
    })
    let newDoc = (new DOMParser()).parseFromString(response.text(), 'text/html');
    initialTable = readEnties(newDoc)
    currentTable = copyTable(initialTable)
    for(let entryElement of document.querySelectorAll('.entry'))
        entryElement.remove()
    for(let entry of Object.values(currentTable)){
        newEntryForm.insertAfter(entry.element)
        listen(entry.element)
    }

    history = []
    historyOffset = -1
    addedEntries = 0
    selection.clear()

    updateButtons()
}
