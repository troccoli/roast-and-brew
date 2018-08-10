// Adds the promise polyfill for IE 11
require('es6-promise').polyfill();

import Vue from 'vue';
import Vuex from 'vuex';
import {cafes} from './modules/cafes.js';
import {user} from './modules/user.js';
import {brewMethods} from './modules/brewMethods.js';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        cafes,
        user,
        brewMethods
    }
});