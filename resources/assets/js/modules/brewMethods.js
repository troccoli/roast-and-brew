import BrewMethodAPI from '../api/brewMethod.js';

/*
 * Load Statuses:
 *
 * status = 0 -> No loading has begun
 * status = 1 -> Loading has started
 * status = 2 -> Loading completed successfully
 * status = 3 -> Loading completed unsuccessfully
 */
export const brewMethods = {
    state: {
        brewMethods          : [],
        brewMethodsLoadStatus: 0,
    },

    actions: {
        loadBrewMethods({commit}) {
            commit('setBrewMethodsLoadStatus', 1);

            BrewMethodAPI.getBrewMethods()
                .then(function (response) {
                    commit('setBrewMethods', response.data);
                    commit('setBrewMethodsLoadStatus', 2);
                })
                .catch(function () {
                    commit('setBrewMethods', []);
                    commit('setBrewMethodsLoadStatus', 3);
                });
        },
    },

    mutations: {
        setBrewMethodsLoadStatus(state, status) {
            state.brewMethodsLoadStatus = status;
        },

        setBrewMethods(state, brewMethods) {
            state.brewMethods = brewMethods;
        },
    },

    getters: {
        getBrewMethodsLoadStatus(state) {
            return state.brewMethodsLoadStatus;
        },

        getBrewMethods(state) {
            return state.brewMethods;
        },
    }
}   ;