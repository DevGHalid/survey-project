export const getUserDataFromLocalStorage = () => {
  return {
    userId: localStorage.getItem("userId"),
    accessToken: localStorage.getItem("accessToken"),
    name: localStorage.getItem("name")
  };
};

export const saveUserDataToLocalStorage = ({ userId, accessToken, name }) => {
  localStorage.setItem("userId", userId);
  localStorage.setItem("accessToken", accessToken);
  localStorage.setItem("name", name);
};

export const removeUserDataFromLocalStorage = () => {
  localStorage.removeItem("userId");
  localStorage.removeItem("accessToken");
  localStorage.removeItem("name");
};

export const checkAuthenticated = user => {
  return (
    user.userId !== null && user.name !== null && user.accessToken !== null
  );
};
