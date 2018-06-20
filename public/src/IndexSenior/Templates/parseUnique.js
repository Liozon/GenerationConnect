
export default function(array, options) {
    if (util.isUndefined(array)) return '';

    return array.filter(function(item, index, arr) {
        return arr.indexOf(item) === index;
    });
};