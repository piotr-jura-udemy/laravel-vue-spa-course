export const is404 = function(err) {
    return err.response && err.response.status && 404 === err.response.status;
};
