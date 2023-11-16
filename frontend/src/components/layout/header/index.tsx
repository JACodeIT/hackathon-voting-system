import { MenuIcon } from "@chakra-ui/react";

interface IProps {
    type: 'default' | 'breadcrumbs';
  }

const Header: React.FC<IProps> = ({type = 'default'}) => {

    const date = new Date();
    const hours = date.getHours();
    let greetings;

    if (hours < 12) greetings =  'morning';
    else if (hours >= 12 && hours <= 17) greetings = 'afternoon';
    else if (hours >= 18 && hours <= 24) greetings = 'evening';

    return (
<div className="flex flex-col mb-6 sticky top-0 z-30">
      <div className="top-0 flex-shrink-0">
        <div 
          className="flex bg-white shadow-md rounded-b bg-right bg-no-repeat bg-contain" 
        //   style={{ backgroundImage: `url(${images.headerAvocadoImage})`}}
        >
          <div className="md:hidden block pl-4 py-4">
            <MenuIcon 
              className="h-5 w-5 cursor-pointer" 
            //   onClick={() => dispatch(layoutActions.displaySidebar(true))}
            />
          </div>
          {type === 'default' && (
            <div className="flex-1 p-4 md:p-6 md:pb-4">
              <p className="text-sm">
                Good {greetings}, 
                <span className="text-primary font-bold capitalize">&nbsp;User!</span>
              </p>
            </div>
          )}
          {type === 'breadcrumbs' && (
            <div className="flex-1 py-4 md:px-4">
              {/* <Breadcrumbs /> */}
            </div>
          )}
        </div>
      </div>
    </div>
    );
};


export default Header;