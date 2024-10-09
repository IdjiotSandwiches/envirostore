import './bootstrap';
import 'flowbite';
import 'tw-elements';
import { Ripple, initTWE } from "tw-elements";
import Glide, { Controls, Breakpoints, Swipe, Autoplay } from '@glidejs/glide/dist/glide.modular.esm'

window.Glide = Glide;
window.Controls = Controls;
window.Breakpoints = Breakpoints;
window.Swipe = Swipe;
window.Autoplay = Autoplay;

initTWE({ Ripple });
