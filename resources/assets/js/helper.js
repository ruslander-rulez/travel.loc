module.exports = {
    presentDateToString: function(date) {
        let internalDate = new Date(date);
        internalDate.setHours( date.getHours() - (date.getTimezoneOffset() / 60));
        return internalDate.toISOString()
    }
}
