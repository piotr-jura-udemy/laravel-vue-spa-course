export const is404 = function(err) {
    return isErrorWithResponseAndStatus(err) === 404;
};

export const is419 = function(err) {
  return isErrorWithResponseAndStatus(err) === 419;
};

export const is422 = function(err) {
    return isErrorWithResponseAndStatus(err) === 422;
};

const isErrorWithResponseAndStatus = function(err) {
    return err.response && err.response.status;
};