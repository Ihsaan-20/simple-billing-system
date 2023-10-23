
function store_key(key, value) {
    console.log('Selected value:', value);

    $.post({
        url: 'store_session.php',
        data: {
            key:key,
            value:value,
        },
        success: function (data) {
            console.log(data);
            var selected_field_text = key;
            var selected_field = selected_field_text.replace("_", " ");
            var selected_field = selected_field.replace("id", " ");
            var message = selected_field+' '+'selected!';
            var new_message = message.charAt(0).toUpperCase() + message.slice(1);
            toastr.success((new_message), {
                CloseButton: true,
                ProgressBar: true
            });
            
        },

    });
};


// function storeKeyValue(id, value) {

//     $.ajax({
//         type: 'POST',
//         url: 'store_session.php', // Replace with the path to your PHP file
//         data: {
//             'id': id,
//             'value': value
//         },
//         success: function(response) {
//            console.log(response);
//            if(response.status == 'success')
//            {
//             Swal.fire(response.message, response.note, response.status); 

//            }else
//            {
//             Swal.fire(response.message, response.note, response.status); 
//            }
           
//         },
//         error: function() {
//             // Handle errors if the AJAX request fails
//             console.error('AJAX request failed');
//         }
//     });
// }



