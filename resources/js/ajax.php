<script>
    const order = document.querySelector('.data__order-field')
    const sortedField = document.querySelector('.data__sort-field')
    const list = document.querySelector('.data__table-inner')
    const filterField = document.querySelector('.data__filter-field')
    const input = document.querySelector('.data__filter-input')
    const data_str = document.querySelectorAll('.data__str-item')
    const delete_link = document.querySelectorAll('.data__delete-link')

    sortedField.addEventListener('change',async (event) => {
    let field = event.target.value
    let orderField = order.value
    let response = await fetch("<?= $data['info']['url'] . '/sort' ?>",{
    'method': 'POST',
    'headers' : {
    'Content-Type': 'application/json',
        },
    'body' :
    JSON.stringify({
    'filter-field' :  field ,
    'order' : orderField
    })
    })
    let data = await response.text()
    list.innerHTML = data;
})
    input.addEventListener('input',async (event) => {
    let data_input = event.target.value
    let field_input = filterField.value
    let response = await fetch("<?= $data['info']['url'] . '/filter' ?>", {
    'method': 'POST',
    'headers': {
    'Content-Type': 'application/json',
},
    'body' : JSON.stringify({
    'input' : data_input,
    'field' : field_input
})
}
    )
    let data = await response.text()
    list.innerHTML  = data
})

    del = async function (event) {
    if (event.target.matches('.img-del')) {
    console.log(event.target)
    let id = event.target.parentElement.dataset.id
    let response = await fetch("<?= $data['info']['url'] . '/delete' ?>",{
    'method' : 'POST',
    'headers' : {
    'Content-Type': 'application/json',
},
    'body' : JSON.stringify({
    'id' : id
})
})
    this.remove()
}
}
    delete_link.forEach((link) => {
    link.addEventListener('click',(event) => {
        console.log(event.target)
        event.preventDefault()
    })
}
    )

    data_str.forEach((str) => {
    str.addEventListener('click', del)
})
</script>