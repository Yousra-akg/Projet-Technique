import './bootstrap';
import 'preline';
import Alpine from 'alpinejs';
import taskManager from './components/taskManager';

window.Alpine = Alpine;

// Register Alpine components
Alpine.data('taskManager', taskManager);

Alpine.start();