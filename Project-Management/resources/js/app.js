import './bootstrap';
import 'preline';
import Alpine from 'alpinejs';
import taskManager from './components/taskManager';

window.Alpine = Alpine;

Alpine.data('taskManager', taskManager);

Alpine.start();