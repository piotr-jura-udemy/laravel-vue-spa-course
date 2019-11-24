export const is404 = function(err) {
    return isErrorWithResponseAndStatus(err) && 404 === err.response.status;
};

export const is422 = function(err) {
    return isErrorWithResponseAndStatus(err) && 422 === err.response.status;
};

const isErrorWithResponseAndStatus = function(err) {
    return err.response && err.response.status;
};
