$(document).ready(function() {
    var CSRF_TOKEN = $('[name="_token"]')[0].value;
    let removes = document.querySelectorAll('.delete-item')
    for (let remove of removes) {
        remove.addEventListener('click', async (event) => {
            let response2 = await fetch('remove-professor', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;'
                },
                body: JSON.stringify({
                    _token: CSRF_TOKEN,
                    id: `${event.target.id}`
                })
            });
            //document.location.reload();
        });
    }});
