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
    },
    confirm: async (e, text) => {
        const url = e.target.href
        e.preventDefault();
        Swal.fire({
            title: 'Smazat?',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url
            }
        })
    }
}
window.App = App;

