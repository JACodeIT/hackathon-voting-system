export interface INavigation {
    name: string; 
    href: string; 
    icon: string;
    iconSelected: string;
    current: boolean;
    isHidden: boolean;
    disabled: boolean;
  }
  
  export interface stateType {
    from: { pathname: string };
  }