/*  
    --------------------------------------------------------------------------
    avg linkscanner inline verdict info popup
    --------------------------------------------------------------------------
*/

// write verdict info and display the inline popup
function avg_ls_showinline(imageElem, msg, blUrl)
{
	//set verdict info
	var flyover = document.getElementById('avg_ls_inline_popup');
	if (flyover == null)
		return;
	
	flyover.innerHTML = msg;
	flyover.style.width = "auto";  //reset width
	flyover.style.position = "absolute";

	if (blUrl === true)
	{	// reset the flyover data with finalurl for blUrl
		var evt = document.createEvent("Events");
		evt.initEvent("xplinlineflyover", true, false);
		flyover.dispatchEvent(evt);
	}

	avg_ls_positioninline(imageElem);
}

function avg_ls_positioninline(imageElem)
{
	var flyover = document.getElementById('avg_ls_inline_popup');
	if (flyover == null)
		return;
		
	// relative position of flyover in relation to icon
	var locateX = 0;  // 0=left, 1=right
	var locateY = 0;  // 0=above, 1=below, 2=beside icon
	
	var scrollXWidth = 19;  // approx
	
	// Must know if there is a horizontal scroll bar for Firefox
	// for proper flyover positioning near bottom edge
	var scrollBarX = false;	//default for Microsoft IE
	var scrollYWidth = 18;	//normally 17 (+1 top border)
	if (window.innerHeight)
	{	// not MSIE
		try
		{
			scrollYWidth = Math.floor(Math.abs(window.innerHeight - document.documentElement.clientHeight)) + 1;
			scrollBarX = (document.documentElement.clientWidth < document.documentElement.scrollWidth);
		}
		catch(err){}
	}
	
	// get window sizes
	if (window.innerHeight == undefined)	// Microsoft IE
	{
		var windowX = (document.documentElement.clientWidth || document.body.clientWidth) - scrollXWidth;
		var windowY = document.documentElement.clientHeight || document.body.clientHeight;
	}
	else
	{
		var windowX = window.innerWidth - scrollXWidth;
		var windowY = window.innerHeight;
		if (scrollBarX)
			windowY -= scrollYWidth;
	}
	
	// get the flyover dimensions
	if (window.getComputedStyle == undefined)	// Microsoft IE
	{
		var flyoverX = parseInt(flyover.offsetWidth);
		var flyoverY = parseInt(flyover.offsetHeight);
	}
	else
	{
		var style = document.defaultView.getComputedStyle(flyover, null);
		var flyoverX = parseInt(style.width);
		var flyoverY = parseInt(style.height);
	}
	
	flyover.style.width = flyoverX + "px";
	
	// get the bounding rect for image(s)
	var imgRect = imageElem.getBoundingClientRect();

	// half width/height (center) of element bounding rect
	var halfX = (imgRect.right - imgRect.left) / 2;
	var halfY = (imgRect.bottom- imgRect.top) / 2;

	// element the mouse is over, get the center position
	var posX = offsetLeft(imageElem) + halfX;
	var posY = offsetTop(imageElem) + halfY;
	
	var pageOffsetX = 0;
	var pageOffsetY = 0;

	// normalize pos to 0  -- get amount of scrolling in browser window
	var hasParentFrame = false;
	if (window.pageXOffset == undefined)	// Microsoft IE
	{
		pageOffsetX = document.documentElement.scrollLeft || document.body.scrollLeft;
		pageOffsetY = document.documentElement.scrollTop || document.body.scrollLeft;
		var frames = document.frames;
		if (frames)
		{
			for (var i=0; i < frames.length; i++)
			{
				if (frames[i].document.getElementById(imageElem.id))
				{
					pageOffsetX = frames[i].document.documentElement.scrollLeft;
					pageOffsetY = frames[i].document.documentElement.scrollTop;
					hasParentFrame = true;
					break;
				}
			}
		}
	}
	else
	{
		pageOffsetX = window.pageXOffset;
		pageOffsetY = window.pageYOffset;
	}
	
	posX -= pageOffsetX;
	posY -= pageOffsetY;

	//compensate for Firefox 3
	if (posX < imgRect.left)
		posX = imgRect.left+halfX;

	// setup the offsets
	var offsetX = posX;
	var offsetY = posY;

	// calc where to display on page
	if ((windowX - posX) > posX)
	{
		// right
		offsetX += halfX;
		locateX = 1;
	}
	else
	{
		//left
		offsetX -= (flyoverX + halfX);
	}
	if ((windowY - posY) > posY)
	{
		// below
		if (posY < (windowY/4))
		{
			offsetY -= halfY;
			locateY = 1;
		}
		else
		{
			offsetY -= (flyoverY / 2) - halfY;
			locateY = 2;
		}
	}
	else
	{
		// above
		if ((windowY - posY) < (windowY/4))
		{
			offsetY -= (flyoverY - halfY);
		}
		else
		{
			offsetY -= (flyoverY / 2) + halfY;
			locateY = 2;
		}
	}
	// make sure we aren't off the screen
	if (offsetY < 0)
		offsetY = 0;

	if ((offsetY + flyoverY) > windowY)
		offsetY = windowY - flyoverY;

	// add page offsets back - if not in frame
	if (!hasParentFrame)
	{
		offsetX += pageOffsetX;
		offsetY += pageOffsetY;
	}
	posX += pageOffsetX;
	posY += pageOffsetY;

	var paddedOffsetX = 0; //provide space between icon and flyover
	var padX = 3;
	if (locateX == 0)
		paddedOffsetX = offsetX - padX;
	else
		paddedOffsetX = offsetX + padX;


	// set where to put the flyover
	flyover.style.top = offsetY + "px";
	flyover.style.left = paddedOffsetX + "px";

	avg_ls_displayinline();
}

function avg_ls_displayinline()
{
	var flyover = document.getElementById('avg_ls_inline_popup');
	if (flyover == null)
		return;
	
	// show the flyover
	flyover.style.visibility = "visible";

}

function avg_ls_hideinline()
{
	var flyover = document.getElementById('avg_ls_inline_popup');
	if (flyover == null)
		return;
		
	flyover.visibility = "hidden";	//invisible
	flyover.style.left = "-5000px";
}

function offsetTop(element)
{
	var offset = 0;
	while (element)
	{
		offset += element.offsetTop;
		element = element.offsetParent;
	}

	return offset;
}

function offsetLeft(element)
{
	var offset = 0;
	while (element)
	{
		offset += element.offsetLeft;
		element = element.offsetParent;
	}
	
	return offset;
}