import UserAPI from '../api/user.js';

/*
 * Load Statuses:
 *
 * status = 0 -> No loading has begun
 * status = 1 -> Loading has started
 * status = 2 -> Loading completed successfully
 * status = 3 -> Loading completed unsuccessfully
 */
export const user = {
    state: {
        user          : {},
        userLoadStatus: 0
    },

    actions: {
        loadUser({commit}, data) {
            commit('setUserLoadStatus', 1);

            UserAPI.getUser()
                .then(function (response) {
                    commit('setUser', response.data);
                    commit('setUserLoadStatus', 2);
                })
                .catch(function () {
                    commit('setUser', {});
                    commit('setUserLoadStatus', 3);
                });
        }
    },

    mutations: {
        setUserLoadStatus(state, status) {
            state.userLoadStatus = status;
        },

        setUser(state, user) {
            state.user = user;
        }
    },

    getters: {
        getUserLoadStatus(state) {
            return state.userLoadStatus;
        },

        getUser(state) {
            return state.user;
        }
    }
};