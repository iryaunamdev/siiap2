import './bootstrap';
import './fontawesome';
import 'flowbite';

import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm.js';
Livewire.start()


import Chart from 'chart.js/auto';    // You can find this in official documentation.
window.Chart = Chart;


/*import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
window.Chart = Chart; //this allows you to use chart outside of "mix"*/



/*tw-elements importation */
/*import { Tooltip, initTWE } from "tw-elements";
initTWE({ Tooltip});*/
