// let firstReqInput = document.getElementById("first_req");
// firstReqInput.addEventListener('click', (e) => {
//     e.target.previousSibling.previousSibling.remove();
//     e.target.remove();
//     // console.log(e.target.previousSibling.previousSibling);
// });

function addRequirement(){
    let r = document.getElementById('requirements'); // the div

    let div = document.createElement('div');

    div.className = "d-flex align-items-center";

    let newR = document.createElement('input');
    newR.setAttribute('class', 'form-control mt-2');
    newR.setAttribute('type', 'text');
    newR.setAttribute('name', 'requirements[]');
    newR.setAttribute('placeholder', 'Nuevo requisito');
    div.appendChild(newR);

    let removeReqBtn = document.createElement('i');
    removeReqBtn.className = "bi bi-trash3-fill close";
    removeReqBtn.ariaLabel = "Close";
    removeReqBtn.addEventListener('click', (e) => {
        e.target.previousSibling.remove();
        e.target.remove();
    });

    div.appendChild(removeReqBtn);

    r.appendChild(div);
}

if (document.querySelectorAll('#first_req') != null) {
    addDeleteFunctionality();
    
}

function addDeleteFunctionality(){
    let buttons = document.querySelectorAll('#first_req');
    buttons.forEach( (btn) => {
        btn.addEventListener('click', (e) => {
            e.target.previousSibling.previousSibling.remove();
            e.target.remove();
        });
    })
}

// Ensure compatibility with Chrome. Datetime needs a T between
// the date and time.
document.querySelectorAll('#dates').forEach( (input) => {
    input.defaultValue = input.defaultValue.replace(/\s/g, 'T');
});

function deleteImage(offer_id, image_id){
    const params = {
        offer_id: offer_id,
        image_id: image_id
    };

    let token = document.getElementsByName('_token')[0].value;

    fetch('/deleteofferimage', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
        method: 'DELETE',
        body: JSON.stringify( params )      

    }).then(function(response){
        window.location = `/offer/edit/${offer_id}`;
    })
}

document.getElementsByName('select_categories').forEach( (option) => {
    option.addEventListener('click', (e) => {
//         e.target.selected = e.target.selected ==true ? false : true;
        e.target.removeAttribute('selected');
    });
}); 