import $ from 'jquery';
import select2 from 'select2';
select2();

// Inicialización básica
window.addEventListener('DOMContentLoaded', () => {
    $('.select2').select2({
        theme:'float'
    });

    $('.select2-sm').select2({
        theme:'float-sm'
    });

    $('.select2-xs').select2({
        theme:'float-xs'
    });
});

/*document.addEventListener('livewire:load', function(){
    $('.select2').select2();
    console.log('select2');
});*/
