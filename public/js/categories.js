// Categories:
var addCategoryBtn = document.getElementById('add_category');
addCategoryBtn.addEventListener('click', addCategory);

var deleteCategoryBtn = document.getElementById('delete_category');
deleteCategoryBtn.addEventListener('click', deleteCategory);

function addCategory(){
    
    const params = {
        category: document.getElementById('inputCategory').value 
    };

    let token = document.getElementsByName('_token')[0].value;
    var err;
    fetch('/addcategory', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
        method: 'POST',
        body: JSON.stringify( params )      

    }).then(function(response){
        // console.log(response.status);
        err = response.status == 422 ? true : false;
        return response.json();
    })
    .then(function(data) {

        document.querySelectorAll('h6').forEach((elem) => elem.innerHTML = "");
        if (!err) {
            document.getElementById('categories_table').innerHTML = "";
            let table = document.getElementById('categories_table');

            data.forEach(category => {
                let tr = document.createElement('tr');
                let td = document.createElement('td');
                td.value = category.name;
                td.innerText = category.name;
                tr.appendChild(td); 
                table.appendChild(tr);
            });
        }
        else{
            Object.entries(data.errors).forEach( (error) => {
                document.getElementById('category_error').innerText = error[1];
            });
        }
        document.getElementById('inputCategory').value = "";
    });
}

function deleteCategory(){
    const params = {
        category: document.getElementById('inputCategory').value 
    };

    let token = document.getElementsByName('_token')[0].value;

    fetch('/deletecategory', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
        method: 'DELETE',
        body: JSON.stringify( params )      

    }).then(function(response){
        return response.json();
    })
    .then(function(categories) {

        document.getElementById('categories_table').innerHTML = "";
        let table = document.getElementById('categories_table');

        categories.forEach(category => {
            let tr = document.createElement('tr');
            let td = document.createElement('td');
            td.value = category.name;
            td.innerText = category.name;
            tr.appendChild(td); 
            table.appendChild(tr);
        });
        document.getElementById('inputCategory').value = "";
    });
    document.getElementById('inputCategory').value = "";
    document.getElementById('category_error').innerHTML = "";
}
