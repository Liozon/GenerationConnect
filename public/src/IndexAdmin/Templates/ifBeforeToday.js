// ifEquals.js
var date = new Date();

export default function (arg1, arg2, options) {    
    return (arg1 < date) ? options.fn(this) : options.inverse(this);
}