let checkbox = document.getElementsByName('all_volunteers')[0];
checkbox.checked = false;
let for_input;

checkbox.addEventListener('click', () => {
    for_input = document.getElementsByName('for')[0];
    for_input.disabled = for_input.disabled == true ? false : true;
});