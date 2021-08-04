export default {
    install: (app, options) => {
        /**
         * 翻译
         *
         * @param _key
         * @returns {*}
         */
        app.config.globalProperties.$trans = (_key) => {
            console.dir(this);
            let trans = this.$store.state.locale;

            let key = _key.split('.');

            while(key.length && (trans = trans[key.shift()])) {}

            return (typeof(trans) !== 'undefined') ? trans : _key;
        }
    }
}
