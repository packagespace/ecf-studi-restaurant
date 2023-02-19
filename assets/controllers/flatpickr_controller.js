// ./controllers/flatpickr_controller.js
// import stimulus-flatpickr wrapper controller to extend it
import Flatpickr from 'stimulus-flatpickr'
import { French } from 'flatpickr/dist/l10n/fr'

export default class extends Flatpickr {
    initialize() {
        this.config = {
            locale: French
        }
    }
}