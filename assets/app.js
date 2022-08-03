import './styles/app.css';
import Swal from 'sweetalert2'


const App = {
    modal: (text) => {
        Swal.fire({
            title: 'Poznámka',
            html: text,
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText:
                'Zavřít',
            confirmButtonAriaLabel: 'Zavřít',
        })
    }
}
window.App = App;
console.log(App)
