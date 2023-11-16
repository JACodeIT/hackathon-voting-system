/////////////////////////////
// setLocalStorageItem()
/////////////////////////////
export const setLocalStorageItem = (storageKey: string, state: string) => {
    localStorage.setItem(storageKey, JSON.stringify(state));
  }
  
  /////////////////////////////
  // getLocalStorageItem()
  /////////////////////////////
  export const getLocalStorageItem = (storageKey: string) => {
    const savedState = localStorage.getItem(storageKey);
    try {
      if (!savedState) {
        return undefined;
      }
      return JSON.parse(savedState ?? '{}');
    } catch (e) {
      return undefined;
    }
  }