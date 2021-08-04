import { createStore } from 'vuex'

export default createStore({
    state: {
        count: 0,
        todos: [
            { id: 1, text: '...', done: true },
            { id: 2, text: '...', done: false }
        ]
    },
    getters: {
        doneTodos (state) {
            return state.todos.filter(todo => todo.done);
        },
    },
    mutations: {
        increment (state) {
            state.count++
        },
    },
    actions: {
        increment (context) {
            context.commit('increment')
        }
    },
});
