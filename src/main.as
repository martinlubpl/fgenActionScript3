 /// ROOT
 //TODO change context menu in videos
import flash.geom.ColorTransform;
if (host == undefined)
{
	imghost = "http://fotogen.ch/";
} else if (host == "fotogen.ch" || host == "www.fotogen.ch")
{
	imghost = "http://" + host + "/";
} else
{
	imghost = "http://www.fotogen.ch/";
}
//website = "face2face";
//section = "seniors";
//Xray.trace("website"+website);
_root.mw = "";
if (website == "face2face")
{
	//var ct:ColorTransform = new ColorTransform(0.7, 0.7, 0.7, 1, -255, 0, 18, 0);
	var ct : ColorTransform = new ColorTransform (1, 1, 1, 1, 10, 10, 10, 0);
	bg.transform.colorTransform = ct;
	resmenu = attachMovie ("menu_f2f", "menu", 2000);
	_root.mw = "women";
	//resmenu.itema.gotoAndStop(5);
	switch (_root.section)
	{
		case "fashion" :
		//was: selMenu from a to g and default a
		selectedMenu = "1";
		break;
		case "business" :
		selectedMenu = "1";
		break;
		case "seniors" :
		selectedMenu = "1";
		break;
		case "exotic" :
		selectedMenu = "1";
		break;
		case "specials" :
		selectedMenu = "1";
		break;
		case "teens" :
		selectedMenu = "1";
		break;
		case "actors" :
		selectedMenu = "1";
		break;
		default :
		selectedMenu = "1";
		break;
	}
	//resmenu["item"+selectedMenu].gotoAndStop(5);
	//resmenu.itemh.gotoAndStop(5);
} else
{
	resmenu = attachMovie ("menu1", "menu", 2000);
	selectedMenu = "1";
}
resmenu._x = 42;
resmenu._y = 96;
_root.menu.item1.womenOn.alphaTo (100, 0.5, "linear");
//clearlb="true"
//sc=448
/*mysnd = new Sound(_level0);
mysnd.setVolume(0);*/
// STYLES
//Create a new style sheet object
var myCSS = new TextField.StyleSheet ();
//Specify the location of the CSS file that you created earlier
var cssURL = "flashstyles.css";
//Load CSS file
myCSS.load (cssURL);
//define onLoad handler
myCSS.onLoad = function (success)
{
	if (success)
	{
		/* If the style sheet loaded without error,
		assign it to the text object, and assign the HTML text to the
		text field*/
		//trace("cssLoaded");
		//myText.styleSheet = myCSS;
		//myText.text = exampleText; //this should be ".htmlText",
		// but Flash seems to recognise that the textbox needs to display html anyway
	}
};
//
if (clearlb == "true")
{
	var liteboxSO : SharedObject = SharedObject.getLocal ("litebox");
	liteboxSO.clear ();
	liteboxSO.flush ();
}
System.security.allowDomain ("www.fotogen.ch", "fotogen.ch", "face-face.ch", "www.face-face.ch", "D|/projekty/chris%20mcneely/fotogen/");
//#include "mc_tween_1_12_9.as"
stop ();
menu.swapDepths (2000);
_root.currentDivision = "start";
//
var startXML = new XML ();
startXML.ignoreWhite = true;
function parseStartXML (success)
{
	//trace("parse start")
	if (success)
	{
		//trace(this.firstChild.childNodes[1].childNodes[0].firstChild.nodeValue);
		if (this.firstChild.childNodes [0].childNodes [1].firstChild.nodeValue == "1")
		{
			_root.newsFlag = true;
			//trace("news flag "+_root.newsFlag);
			_root.newsText = this.firstChild.childNodes [0].childNodes [0].firstChild.nodeValue;
			//trace(_root.newsText);
			if (_root.newsFlag)
			{
				//trace("newsflag");
				attachMovie ("news", "news1", 9000);
				news1._x = 337;
				news1._y = 149;
			}
		}
		startNode = this.firstChild.firstChild;
		len = startNode.childNodes.length;
		_root.startArray = new Array ();
		for (i = 0; i < 12; i ++)
		{
			//trace(startNode.childNodes[i]);
			startArray [i] = new Array ();
			startArray [i]['id'] = startNode.childNodes [i].childNodes [0].firstChild.nodeValue;
			startArray [i]['national'] = startNode.childNodes [i].childNodes [1].firstChild.nodeValue;
			startArray [i]['date_entry'] = startNode.childNodes [i].childNodes [2].firstChild.nodeValue;
			startArray [i]['date_last_changed'] = startNode.childNodes [i].childNodes [3].firstChild.nodeValue;
			startArray [i]['active'] = startNode.childNodes [i].childNodes [4].firstChild.nodeValue;
			startArray [i]['first_name'] = startNode.childNodes [i].childNodes [5].firstChild.nodeValue;
			startArray [i]['last_name'] = startNode.childNodes [i].childNodes [6].firstChild.nodeValue;
			startArray [i]['nick_name'] = startNode.childNodes [i].childNodes [7].firstChild.nodeValue;
			startArray [i]['height'] = startNode.childNodes [i].childNodes [8].firstChild.nodeValue;
			startArray [i]['chest'] = startNode.childNodes [i].childNodes [9].firstChild.nodeValue;
			startArray [i]['waist'] = startNode.childNodes [i].childNodes [10].firstChild.nodeValue;
			startArray [i]['hips'] = startNode.childNodes [i].childNodes [11].firstChild.nodeValue;
			startArray [i]['size'] = startNode.childNodes [i].childNodes [12].firstChild.nodeValue;
			startArray [i]['shoes'] = startNode.childNodes [i].childNodes [13].firstChild.nodeValue;
			startArray [i]['eyes'] = startNode.childNodes [i].childNodes [14].firstChild.nodeValue;
			startArray [i]['hair'] = startNode.childNodes [i].childNodes [15].firstChild.nodeValue;
			startArray [i]['images1'] = startNode.childNodes [i].childNodes [16].firstChild.nodeValue;
			startArray [i]['images2'] = startNode.childNodes [i].childNodes [17].firstChild.nodeValue;
			startArray [i]['movies'] = startNode.childNodes [i].childNodes [18].firstChild.nodeValue;
			startArray [i]['start_page_flag'] = startNode.childNodes [i].childNodes [19].firstChild.nodeValue;
			startArray [i]['new_face_flag'] = startNode.childNodes [i].childNodes [20].firstChild.nodeValue;
			startArray [i]['sed_card_big_image_flag'] = startNode.childNodes [i].childNodes [21].firstChild.nodeValue;
			startArray [i]['category'] = startNode.childNodes [i].childNodes [22].firstChild.nodeValue;
			startArray [i]['man_woman'] = startNode.childNodes [i].childNodes [23].firstChild.nodeValue;
			startArray [i]['pdf_file'] = startNode.childNodes [i].childNodes [24].firstChild.nodeValue;
			startArray [i]['images'] = new Array ();
			len2 = startNode.childNodes [i].childNodes [25].childNodes.length;
			for (j = 0; j < len2; j ++)
			{
				startArray [i]['images'][j] = new Array ();
				//trace(startNode.childNodes[i].childNodes[24].childNodes[j].childNodes[0].firstChild.nodeValue);
				startArray [i]['images'][j]['id'] = startNode.childNodes [i].childNodes [25].childNodes [j].childNodes [0].firstChild.nodeValue;
				startArray [i]['images'][j]['stamp'] = startNode.childNodes [i].childNodes [25].childNodes [j].childNodes [1].firstChild.nodeValue;
				startArray [i]['images'][j]['model_id'] = startNode.childNodes [i].childNodes [25].childNodes [j].childNodes [2].firstChild.nodeValue;
				startArray [i]['images'][j]['start_page'] = startNode.childNodes [i].childNodes [25].childNodes [j].childNodes [3].firstChild.nodeValue;
				startArray [i]['images'][j]['sed_card'] = startNode.childNodes [i].childNodes [25].childNodes [j].childNodes [4].firstChild.nodeValue;
				startArray [i]['images'][j]['new_face'] = startNode.childNodes [i].childNodes [25].childNodes [j].childNodes [5].firstChild.nodeValue;
			}
		}
		if (sc == undefined)
		{
			// NO INTRO
			//_root.gotoAndStop("news");
			//_root.gotoAndStop("intro");
		} else
		{
			//_root.gotoAndStop("news");
		}
	} else
	{
		//trace("xml not loaded");
		startXML.load ("getstartxml.php");
	}
}
/// !!!! MOVED TO DIVISION WITH CHECKING IF INTRO FINISHED function checkIntro and introEnd
startXML.onLoad = parseStartXML;
//startXML.load("http://fotogen.ch/getstartxml.php");
//trace(_root.website);
if (sc == undefined)
{
	//trace("INTRO");
	_root.gotoAndStop ("intro");
} else
{
	//trace("NO INTRO");
	_root.gotoAndStop ("news");
}
////////////////////// MYTRACE
_root.traceBox.vScrollPolicy = "on";
traceBox.swapDepths (9999);
function mytrace (msg)
{
	_root.traceBox.text += msg + newline;
	_root.traceBox.vPosition = _root.traceBox.maxVPosition;
}
//// UNLOAD DIVISION
function unloadPal ()
{
	if (_root.contact1 != undefined)
	{
		_root.contact1.closing = true;
		_root.contact1.gotoAndPlay (51);
	}
	if (_root.agency1 != undefined)
	{
		_root.agency1.closing = true;
		_root.agency1.gotoAndPlay (51);
	}
	if (_root.events != undefined)
	{
		_root.events.gotoAndPlay (21);
	}
	if (_root.faq1 != undefined)
	{
		_root.faq1.closing = true;
		_root.faq1.gotoAndPlay (51);
	}
	if (_root.help1 != undefined)
	{
		// remove help
	}
}
//SEC UNLOAD DIV
function unloadDivision ()
{
	//trace ("going back" + goingback)
	if ( ! goingback)
	{
		addHistory ();
	} else
	{
		//goingback = false;
	}
	trace ("!!!UNLOAD: " + _root.currentDivision);
	if (_root.nextDivision != "search")
	{
		blockApp ();
	}
	if (_root.currentDivision == "search")
	{
		if (_root.nextDivision == "sedcard" || _root.nextDivision == "mainLB" || _root.nextDivision == "polaroids")
		{
			//_root.backDivision = _root.currentDivision;
			//_root.backPage = _root.search1.currentPage;
		}
		_root.search1.alphaTo (0, 2, "linear");
		_root.search1.onTweenComplete = function ()
		{
			_root.loadDivision ("unload div search");
			this.removeMovieClip ();
		};
	} 
	else if (_root.currentDivision == "mainLB")
	{
		//trace(_root.mainLB1.total);
		_root.mainLB1.rightMenu1.alphaTo (0, 0.5, "linear");
		_root.mainLB1.slider.alphaTo (0, 0.5, "linear");
		//trace("llength mainLBArray: "+_root.mainLBArray.length)
		if (_root.mainLBArray.length == 0 || _root.mainLBArray.length == undefined)
		{
			_root.mainLB1.removeMovieClip ();
			trace ("zero - removemc  LB")
			_root.loadDivision ("unload div mainLB");
		} else
		{
			trace ("more than 0 in LB")
			for (i = 0; i < _root.mainLB1.current; i ++)
			{
				_root.mainLB1 ["mainLBpic" + i].mirror._alpha = 20;
				_root.mainLB1 ["mainLBpic" + i].alphaTo (0, 0.5, "linear", 0.1 * i);
				trace ("_root.mainLB1.current " + _root.mainLB1.current);
				if (i == _root.mainLB1.current - 1)
				{
					_root.mainLB1 ["mainLBpic" + i].onTweenComplete = function ()
					{
						trace ("last LB");
						_root.loadDivision ("unload div mainLB lastLB");
					};
				}
			}
		}
	} 
	else if (_root.currentDivision == "polaroids")
	{
		if (_root.nextDivision == "mainLB")
		{
			//_root.backDivision = _root.currentDivision;
			//_root.backPolaroidsDivision = _root.polaroidsDivision;
			//_root.backPolaroidsSubdivision = _root.polaroidsSubdivision;
			//_root.backPolaroidsId = _root.polaroidsId;
			//_root.backPolaroidsLetter = _root.polaroidsLetter;
			//_root.backSubdivision = _root.currentSubdivision;
			//_root.backPage = _root.search1.currentPage;
		}
		_root.polaroids1.alphaTo (0, 1, "linear");
		_root.polaroids1.onTweenComplete = function ()
		{
			_root.loadDivision ("unload div polas");
			this.removeMovieClip ();
		};
	} 
	else if (_root.currentDivision == "videos")
	{
		trace ("leaving videos adios")
		trace("sc div" + _root.sedcardDivision)
		if (_root.nextDivision == "mainLB")
		{
			//_root.backDivision = _root.currentDivision;
			//_root.backSedcardDivision = _root.sedcardDivision;
			//_root.backSedcardSubdivision = _root.sedcardSubdivision;
			//_root.backSedcardId = _root.sedcardId;
			//_root.backSedcardLetter = _root.sedcardLetter;
			//_root.backPage = _root.search1.currentPage;
		}
		/* unnecessary cause unloading's not working when player is active
		 _root.videos1.player_mc.player.pause();
		_root.videos1.player_mc.alphaTo (0, 0.5, "linear")
		*/
		_root.videos1.alphaTo (0, 1, "linear");
		_root.videos1.onTweenComplete = function ()
		{
			_root.loadDivision ("unload div video");
			this.removeMovieClip ();
		};
	} 
	else if (_root.currentDivision == "sedcard")
	{
		if (_root.nextDivision == "videos" && !_root.goingback)
		{	
			_root.videoId = _root.sedcardId;
			_root.videoLetter = _root.sedcardLetter;
			_root.videoDivision = _root.sedcardDivision;
			_root.videoSubdivision = _root.sedcardSubdivision;
		}
		if (_root.nextDivision == "mainLB")
		{
			//_root.backDivision = _root.currentDivision;
			//_root.backSedcardDivision = _root.sedcardDivision;
			//_root.backSedcardSubdivision = _root.sedcardSubdivision;
			//_root.backSedcardId = _root.sedcardId;
			//_root.backSedcardLetter = _root.sedcardLetter;
			//_root.backPage = _root.search1.currentPage;
		}
		_root.sedcard1.bigPic1.mirror._alpha = 0;
		_root.sedcard1.bigPic1.nameBigPic.bigName2._alpha = 0;
		_root.sedcard1.alphaTo (0, 1, "linear");
		_root.sedcard1.onTweenComplete = function ()
		{
			_root.loadDivision ("unload div SC");
			this.removeMovieClip ();
		};
	} 
	else if (_root.currentDivision == "start")
	{
		_root [_root.currentDivision + "1"].endHide ();
		_root [_root.currentDivision + "1"].rightMenu1.alphaTo (0, 1, "linear");
		_root [_root.currentDivision + "1"].rightMenu1.onTweenComplete = function ()
		{
			//trace("right");
			this.removeMovieClip ();
		};
	} 
	else if (_root.currentDivision == "men" || _root.currentDivision == "people" || _root.currentDivision == "women")
	{
		//
		if (_root.nextDivision == "videos")
		{
			_root.videoLetter = _root.division1.currentLetter;
			_root.videoDivision = _root.division1.division;
			_root.videoSubdivision = _root.division1.subdivision;
		}
		if (_root.division1.sedcardLetter == "All")
		{
			//_root.backLetter = "All";
			_root.sedcardLetter = "All";
		} else
		{
			//_root.backLetter = _root.division1.currentLetter;
			_root.sedcardLetter = _root.division1.currentLetter;
		}
		if (_root.nextDivision == "sedcard" || _root.nextDivision == "mainLB" || _root.nextDivision == "polaroids")
		{
			//_root.backDivision = _root.currentDivision;
			//_root.backSubdivision = _root.currentSubdivision;
			//_root.backPage = _root.division1.currentPage;
			
		}
		_root.division1.endHide ();
		_root.division1.rightMenu1.alphaTo (0, 1, "linear");
		_root.division1.rightMenu1.onTweenComplete = function ()
		{
			//trace("right");
			this.removeMovieClip ();
		};
	}
}
//SEC LOAD DIVISION
function loadDivision (mycaller)
{
	trace ("++++++++++++++" + newline + "!!!LOAD DIV" + _root.nextDivision + newline + "subdiv:" + _root.nextSubdivision + newline + "+++++++++++++++")
	if (_root.sedcard1 != undefined)
	{
		trace ("sedcard1 present")
	};
	if (_root.mainLB1 != undefined)
	{
		trace ("mainLB1 present")
	}
	if (_root.nextDivision == _root.currentDivision)
	{
		trace ("the same div");
		//return false;
		
	}
	//trace ("after return")
	//trace("next div "+_root.nextDivision);
	//trace("next sub "+_root.nextSubdivision);
	if (arguments.caller == _root.unloadDivision)
	{
		trace ("wywolane przez unlD");
	} else if (arguments.caller == _root.loadDivision)
	{
		trace ("wywolane przez loadD");
	}
	//checkCaller(_root.sedcard1, arguments.caller);
	//checkCaller(_root.sedcard1.bigPic1, arguments.caller);
	_root.search1.removeMovieClip ();
	_root.polaroids1.removeMovieClip ();
	_root.start1.removeMovieClip ();
	_root.division1.removeMovieClip ();
	_root.sedcard1.removeMovieClip ();
	_root.news1.removeMovieClip ();
	_root.mainLB1.removeMovieClip ();
	_root.videos1.removeMovieClip ();
	//SEC next LB
	if (_root.nextDivision == "mainLB")
	{
		//trace("loading mainLB");
		trace ("currentDivision: " + _root.currentDivision)
		trace ("nextDivision: " + _root.nextDivision)
		if (_root.currentDivision == "women" || _root.currentDivision == "men" || _root.currentDivision == "people")
		{
			//
		}
		res = _root.attachMovie ("mainLB", "mainLB1", 1000);
		res._x = - 38;
		res._y = - 64;
		res.attachMovie ("sedcardBack", "sedcardBack", 3465);
		res.sedcardBack._x = 113;
		res.sedcardBack._y = 206;
		res.sedcardBack.onRelease = function ()
		{
			trace ("backhistory2")
			//_root.nextDivision = "back";
			_root.backHistory ();
			_root.unloadDivision ();
		};
		_root.currentDivision = _root.nextDivision;
	} 
	else if (_root.nextDivision == "women" || _root.nextDivision == "men" || _root.nextDivision == "people")
	{
		//mytrace("to wom man people");
		res = _root.attachMovie ("division", "division1", 1000);
		res.division = _root.nextDivision;
		res.subdivision = _root.nextSubdivision;
		//SEC set page/letter in division
		if (_root.nextPage)
		{
			res.currentPage = _root.nextPage;
			delete _root.nextPage;
		}
		if (_root.nextLetter)
		{
			res.currentLetter = _root.nextLetter;
		}
		//mytrace("division "+_root.division1.division);
		res._x = 54;
		res._y = 149;
		//mytrace(res);
		_root.currentDivision = _root.nextDivision;
		_root.currentSubdivision = _root.nextSubdivision;
		trace("cSD "+_root.currentSubdivision)
	}
	//
	else if (_root.nextDivision == "polaroids")
	{
		res = _root.attachMovie ("polaroids", "polaroids1", 1000);
		if (_root.currentDivision == "women" || _root.currentDivision == "men" || _root.currentDivision == "people")
		{
			if (_root.polaroidsLetter == "All")
			{
				//_root.backLetter = "All";
				if (_root.polaroidsSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.polaroidsSubdivision == "international" || _root.polaroidsSubdivision == "newface" || _root.polaroidsSubdivision == "fashion" || _root.polaroidsSubdivision == "business" || _root.polaroidsSubdivision == "seniors" || _root.polaroidsSubdivision == "exotic" || _root.polaroidsSubdivision == "specials" || _root.polaroidsSubdivision == "teens" || _root.polaroidsSubdivision == "actors")
				{
					suff = _root.polaroidsSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = _root [_root.polaroidsDivision + suff + "Array"][_root.polaroidsId];
			} else
			{
				//_root.backLetter = _root.polaroidsLetter;
				//trace("letter "+_root.polaroidsLetter);
				res.modelArray = _root.letterArray [_root.polaroidsId];
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 465);
			res.sedcardBack._x = 48;
			res.sedcardBack._y = 530;
			res.sedcardBack.onRelease = function ()
			{
				trace ("backhistory3")
				_root.backHistory ();
				_root.unloadDivision ();
				/*_root.nextDivision = "back";
				//trace("pola div "+_root.polaroidsDivision);
				_root.backDivision = _root.polaroidsDivision;
				_root.backSubdivision = _root.polaroidsSubdivision;
				_root.backLetter = _root.polaroidsLetter;
				//_root.backPage = _root.sedcardPage;
				_root.unloadDivision();*/
			};
		} else if (_root.currentDivision == "start")
		{
			res.modelArray = _root.startArray [_root.polaroidsId];
		} else if (_root.currentDivision == "mainLB")
		{
			if (goingback)
			{
				if (_root.polaroidsLetter == "All")
				{
					if (_root.polaroidsSubdivision == "intown")
					{
						suff = "national";
					} else if (_root.polaroidsSubdivision == "international" || _root.polaroidsSubdivision == "newface" || _root.polaroidsSubdivision.substr (0, 7) == "fashion" || _root.polaroidsSubdivision.substr (0, 8) == "business" || _root.polaroidsSubdivision.substr (0, 7) == "seniors" || _root.polaroidsSubdivision.substr (0, 6) == "exotic" || _root.polaroidsSubdivision.substr (0, 7) == "special" || _root.polaroidsSubdivision.substr (0, 5) == "teens" || _root.polaroidsSubdivision.substr (0, 6) == "actors" || _root.polaroidsSubdivision == "women" || _root.polaroidsSubdivision == "men" || _root.polaroidsSubdivision.substr (0, 3) == "All")
					{
						suff = _root.polaroidsSubdivision;
					} else
					{
						suff = "";
					}
					res.modelArray = _root.copyObject (_root [_root.polaroidsDivision + suff + "Array"][_root.polaroidsId]);
				} else
				{
					res.modelArray = copyObject (_root.letterArray [_root.polaroidsId]);
				}
			} else
			{
				res.modelArray = _root.mainLBArray [_root.polaroidsId];
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 465);
			res.sedcardBack._x = 48;
			res.sedcardBack._y = 530;
			res.sedcardBack.onRelease = function ()
			{
				//_root.nextDivision = "back";
				_root.backHistory ();
				_root.unloadDivision ();
			};
		} else if (_root.currentDivision == "search")
		{
			res.modelArray = _root.searchArray [_root.polaroidsId];
			res.attachMovie ("sedcardBack", "sedcardBack", 465);
			res.sedcardBack._x = 48;
			res.sedcardBack._y = 530;
			res.sedcardBack.onRelease = function ()
			{
				trace ("backhistory4")
				/*_root.nextDivision = "back";
				//trace("pola div "+_root.polaroidsDivision);
				_root.backDivision = _root.polaroidsDivision;
				_root.backSubdivision = _root.polaroidsSubdivision;
				_root.backLetter = _root.polaroidsLetter;
				//_root.backPage = _root.sedcardPage;*/
				_root.backHistory ();
				_root.unloadDivision ();
			};
		} else if (_root.currentDivision == "sedcard" || _root.currentDivision == "videos")
		{
			if (_root.polaroidsLetter == "All")
			{
				//_root.backLetter = "All";
				if (_root.polaroidsSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.polaroidsSubdivision == "international" || _root.polaroidsSubdivision == "newface" || _root.polaroidsSubdivision == "fashion" || _root.polaroidsSubdivision == "business" || _root.polaroidsSubdivision == "seniors" || _root.polaroidsSubdivision == "exotic" || _root.polaroidsSubdivision == "specials" || _root.polaroidsSubdivision == "teens" || _root.polaroidsSubdivision == "actors")
				{
					suff = _root.polaroidsSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = copyObject (_root [_root.polaroidsDivision + suff + "Array"][_root.polaroidsId]);
			} else
			{
				//_root.backLetter = _root.polaroidsLetter;
				//trace("letter "+_root.polaroidsLetter);
				//res.modelArray = _root.letterArray[_root.sedcardId];
				res.modelArray = copyObject (_root.letterArray [_root.polaroidsId]);
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 465);
			res.sedcardBack._x = 48;
			res.sedcardBack._y = 530;
			res.sedcardBack.onRelease = function ()
			{
				//_root.nextDivision = "back";
				//trace("pola div "+_root.polaroidsDivision);
				//_root.backDivision = _root.polaroidsDivision;
				//_root.backSubdivision = _root.polaroidsSubdivision;
				//_root.backLetter = _root.polaroidsLetter;
				//_root.backPage = _root.sedcardPage;
				trace ("his back polas to sc");
				_root.backHistory ();
				_root.unloadDivision ();
			};
		}
		_root.currentDivision = _root.nextDivision;
	}
	//
	else if (_root.nextDivision == "back")
	{
		_parent.clearAll ();
		if (_root.backDivision == "women")
		{
			_root.menu.item1.gotoAndStop (1);
			_root.menu.item1.womenOn.alphaTo (100, 0.5, "linear");
			_root.selectedMenu = 1;
			_root.nextDivision = "women";
		} else if (_root.backDivision == "men")
		{
			_root.menu.item2.gotoAndStop (1);
			_root.menu.item2.menOn.alphaTo (100, 0.5, "linear");
			_root.selectedMenu = 2;
			_root.nextDivision = "men";
		} else if (_root.backDivision == "people")
		{
			_root.menu.item3.gotoAndStop (1);
			_root.menu.item3.peopleOn.alphaTo (100, 0.5, "linear");
			_root.selectedMenu = 3;
			if (_root.website == "face2face")
			{
				//trace("backsub"+_root.backSubdivision);
				switch (_root.backSubdivision)
				{
					case "fashion" :
					_root.menu.itema.gotoAndPlay (2);
					break;
					case "business" :
					_root.menu.itemb.gotoAndPlay (2);
					break;
					case "seniors" :
					_root.menu.itemc.gotoAndPlay (2);
					break;
					case "exotic" :
					_root.menu.itemd.gotoAndPlay (2);
					break;
					case "specials" :
					_root.menu.iteme.gotoAndPlay (2);
					break;
					case "teens" :
					_root.menu.itemf.gotoAndPlay (2);
					break;
					case "actors" :
					_root.menu.itemg.gotoAndPlay (2);
					break;
					case "women" :
					_root.menu.itemh.gotoAndPlay (2);
					break;
					case "men" :
					_root.menu.itemi.gotoAndPlay (2);
					break;
				}
			}
			_root.nextDivision = "people";
		} else if (_root.backDivision == "search")
		{
			_root.menu.item7.gotoAndPlay (2);
			_root.selectedMenu = 7;
			_root.nextDivision = "search";
		} else if (_root.backDivision == "sedcard")
		{
			//trace("back to sedcard");
			_root.nextDivision = "sedcard";
			_root.currentDivision = _root.backSedcardDivision;
			_root.sedcardDivision = _root.backSedcardDivision;
			_root.sedcardSubdivision = _root.backSedcardSubdivision;
		} else if (_root.backDivision == "polaroids")
		{
			//trace("back to polaroids");
			_root.nextDivision = "polaroids";
			_root.currentDivision = _root.backPolaroidsDivision;
			_root.polaroidsDivision = _root.backPolaroidsDivision;
			_root.polaroidsSubdivision = _root.backPolaroidsSubdivision;
		}
		_root.unloadPal ();
		trace ("load div from back");
		_root.loadDivision ("load div BACK!!!");
	} else if (_root.nextDivision == "sedcard")
	{
		//SEC next div SC
		trace (" next div SEDCARD");
		//trace(arguments.caller);
		res = _root.attachMovie ("sedcard", "sedcard1", 1000);
		delete res.onTweenComplete;
		if(_root.currentDivision == "videos") 
		{
			trace(_root.sedcardDivision)
			if(goingback)
			{
				//
			}
			if(_root.sedcardLetter == "All" || _root.sedcardLetter == undefined)
			{
				if (_root.sedcardSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.sedcardSubdivision == "international" || _root.sedcardSubdivision == "newface" || _root.sedcardSubdivision.substr (0, 7) == "fashion" || _root.sedcardSubdivision.substr (0, 8) == "business" || _root.sedcardSubdivision.substr (0, 7) == "seniors" || _root.sedcardSubdivision.substr (0, 6) == "exotic" || _root.sedcardSubdivision.substr (0, 7) == "special" || _root.sedcardSubdivision.substr (0, 5) == "teens" || _root.sedcardSubdivision.substr (0, 6) == "actors" || _root.sedcardSubdivision == "women" || _root.sedcardSubdivision == "men" || _root.sedcardSubdivision.substr (0, 3) == "All")
				{
					suff = _root.sedcardSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = _root.copyObject (_root [_root.sedcardDivision + suff + "Array"][_root.sedcardId]);
			} else 
			{
				res.modelArray = copyObject (_root.letterArray [_root.sedcardId]);
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				if ( ! _root.appBusy)
				{
					_root.backHistory ();
					_root.unloadDivision ();
				}
			};
			
		}
		else if (_root.currentDivision == "women" || _root.currentDivision == "men" || _root.currentDivision == "people")
		{
			//trace("sedcardletter"+_root.sedcardLetter);
			//trace("sedcarddivision"+_root.sedcardDivision);
			if (_root.sedcardLetter == "All")
			{
				//_root.backLetter = "All";
				if (_root.sedcardSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.sedcardSubdivision == "international" || _root.sedcardSubdivision == "newface" || _root.sedcardSubdivision.substr (0, 7) == "fashion" || _root.sedcardSubdivision.substr (0, 8) == "business" || _root.sedcardSubdivision.substr (0, 7) == "seniors" || _root.sedcardSubdivision.substr (0, 6) == "exotic" || _root.sedcardSubdivision.substr (0, 7) == "special" || _root.sedcardSubdivision.substr (0, 5) == "teens" || _root.sedcardSubdivision.substr (0, 6) == "actors" || _root.sedcardSubdivision == "women" || _root.sedcardSubdivision == "men" || _root.sedcardSubdivision.substr (0, 3) == "All")
				{
					suff = _root.sedcardSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = _root.copyObject (_root [_root.sedcardDivision + suff + "Array"][_root.sedcardId]);
				res.testvar = 1;
			} else
			{
				//_root.backLetter = _root.sedcardLetter;
				//trace("letter "+_root.sedcardLetter);
				//res.modelArray = _root.letterArray[_root.sedcardId];
				res.modelArray = copyObject (_root.letterArray [_root.sedcardId]);
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				if ( ! _root.appBusy)
				{
					_root.backHistory ();
					_root.unloadDivision ();
				}
			};
			addNextBtn ();
		} else if (_root.currentDivision == "start")
		{
			//_root.backDivision = "start"
			res.modelArray = _root.startArray [_root.sedcardId];
			//res.attachMovie("sedcardBack","sedcardBack",3465)
		} else if (_root.currentDivision == "mainLB")
		{
			//trace("abab" + goingback)
			if (goingback)
			{
				if (_root.sedcardLetter == "All")
				{
					//_root.backLetter = "All";
					if (_root.sedcardSubdivision == "intown")
					{
						suff = "national";
					} else if (_root.sedcardSubdivision == "international" || _root.sedcardSubdivision == "newface" || _root.sedcardSubdivision.substr (0, 7) == "fashion" || _root.sedcardSubdivision.substr (0, 8) == "business" || _root.sedcardSubdivision.substr (0, 7) == "seniors" || _root.sedcardSubdivision.substr (0, 6) == "exotic" || _root.sedcardSubdivision.substr (0, 7) == "special" || _root.sedcardSubdivision.substr (0, 5) == "teens" || _root.sedcardSubdivision.substr (0, 6) == "actors" || _root.sedcardSubdivision == "women" || _root.sedcardSubdivision == "men" || _root.sedcardSubdivision.substr (0, 3) == "All")
					{
						suff = _root.sedcardSubdivision;
					} else
					{
						suff = "";
					}
					res.modelArray = _root.copyObject (_root [_root.sedcardDivision + suff + "Array"][_root.sedcardId]);
					//res.testvar = 1;
				} else
				{
					//_root.backLetter = _root.sedcardLetter;
					//trace("letter "+_root.sedcardLetter);
					//res.modelArray = _root.letterArray[_root.sedcardId];
					res.modelArray = copyObject (_root.letterArray [_root.sedcardId]);
				}
			} else
			{
				res.modelArray = _root.mainLBArray [_root.sedcardId];
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				if ( ! _root.appBusy)
				{
					_root.backHistory ();
					_root.unloadDivision ();
				}
			};
			addNextBtn ();
			//
			
		} else if (_root.currentDivision == "polaroids")
		{
			//trace("div:"+_root.polaroidsDivision);
			//trace("id:"+_root.polaroidsId);
			if (_root.polaroidsLetter == "All" || _root.polaroidsLetter == undefined)
			{
				if (_root.polaroidsSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.polaroidsSubdivision == "international" || _root.polaroidsSubdivision == "newface" || _root.sedcardSubdivision == "fashion" || _root.sedcardSubdivision == "business" || _root.sedcardSubdivision == "seniors" || _root.sedcardSubdivision == "exotic" || _root.sedcardSubdivision == "specials" || _root.sedcardSubdivision == "teens" || _root.sedcardSubdivision == "actors")
				{
					suff = _root.polaroidsSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = copyObject (_root [_root.polaroidsDivision + suff + "Array"][_root.polaroidsId]);
			} else
			{
				//trace("lett:"+_root.polaroidsLetter);
				//trace("id:"+_root.polaroidsId);
				res.modelArray = copyObject (_root.letterArray [_root.polaroidsId]);
			}
			if (sedcardDivision == "mainLB")
			{
				trace ("scdiv mainLB" + newline + mainLBArray)
				res.modelArray = _root.mainLBArray [_root.sedcardId];
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				//_root.nextDivision = "back";
				//trace("sedcard div "+_root.sedcardDivision);
				//_root.backDivision = _root.sedcardDivision;
				//_root.backSubdivision = _root.sedcardSubdivision;
				//_root.backLetter = _root.sedcardLetter;
				//_root.backPage = _root.sedcardPage;
				trace ("back sc to pola");
				_root.backHistory ();
				_root.unloadDivision ();
			};
			addNextBtn ();
		} else if (_root.currentDivision == "search")
		{
			//_root.clearMenu();
			res.modelArray = copyObject (_root.searchArray [_root.sedcardId]);
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				//_root.nextDivision = "back";
				//_root.backDivision = _root.sedcardDivision;
				//_root.backSubdivision = _root.sedcardSubdivision;
				//_root.backLetter = _root.sedcardLetter;
				_root.backHistory ();
				_root.unloadDivision ();
			};
			addNextBtn ();
		}
		_root.currentDivision = _root.nextDivision;
	} else if (_root.nextDivision == "videos")
	{
		//SEC load VIDEOS
		trace (" next div VIDEOS");
		//trace(arguments.caller);
		res = _root.attachMovie ("videos1", "videos1", 1000);
		delete res.onTweenComplete;
		if (_root.currentDivision == "sedcard")
		{
			
			if (_root.videoLetter == "All")
			{
				trace("from SC to videos letter all")
				trace("videoDiv:"+_root.videoDivision)
				trace("videoSubdivision:"+_root.videoSubdivision)
				if (_root.videoSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.videoSubdivision == "international" || _root.videoSubdivision == "newface" || _root.videoSubdivision.substr (0, 7) == "fashion" || _root.videoSubdivision.substr (0, 8) == "business" || _root.videoSubdivision.substr (0, 7) == "seniors" || _root.videoSubdivision.substr (0, 6) == "exotic" || _root.videoSubdivision.substr (0, 7) == "special" || _root.videoSubdivision.substr (0, 5) == "teens" || _root.videoSubdivision.substr (0, 6) == "actors" || _root.videoSubdivision == "women" || _root.videoSubdivision == "men" || _root.videoSubdivision.substr (0, 3) == "All")
				{
					suff = _root.videoSubdivision;
				} else
				{
					suff = "";
				}
				trace("suff:"+suff)
				trace("videoId:"+_root.videoId)
				res.modelArray = _root.copyObject (_root [_root.videoDivision + suff + "Array"][_root.videoId]);
			} else
			{
				//_root.backLetter = _root.sedcardLetter;
				//trace("letter "+_root.sedcardLetter);
				//res.modelArray = _root.letterArray[_root.sedcardId];
				res.modelArray = copyObject (_root.letterArray [_root.videoId]);
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				if ( ! _root.appBusy)
				{
					_root.backHistory ();
					_root.unloadDivision ();
				}
			};
		}
		if (_root.currentDivision == "women" || _root.currentDivision == "men" || _root.currentDivision == "people")
		{
			//trace("sedcardletter"+_root.sedcardLetter);
			//trace("sedcarddivision"+_root.sedcardDivision);
			//trace("videoLetter " + _root.videoLetter);
			if (_root.videoLetter == "All")
			{
				if (_root.videoSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.videoSubdivision == "international" || _root.videoSubdivision == "newface" || _root.videoSubdivision.substr (0, 7) == "fashion" || _root.videoSubdivision.substr (0, 8) == "business" || _root.videoSubdivision.substr (0, 7) == "seniors" || _root.videoSubdivision.substr (0, 6) == "exotic" || _root.videoSubdivision.substr (0, 7) == "special" || _root.videoSubdivision.substr (0, 5) == "teens" || _root.videoSubdivision.substr (0, 6) == "actors" || _root.videoSubdivision == "women" || _root.videoSubdivision == "men" || _root.videoSubdivision.substr (0, 3) == "All")
				{
					suff = _root.videoSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = _root.copyObject (_root [_root.videoDivision + suff + "Array"][_root.videoId]);
				//res.testvar = 1;
				
			} else
			{
				//_root.backLetter = _root.sedcardLetter;
				//trace("letter "+_root.sedcardLetter);
				//res.modelArray = _root.letterArray[_root.sedcardId];
				res.modelArray = copyObject (_root.letterArray [_root.videoId]);
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				if ( ! _root.appBusy)
				{
					_root.backHistory ();
					_root.unloadDivision ();
				}
			};
			//addNextBtn ();
			
		} else if (_root.currentDivision == "start")
		{
			//_root.backDivision = "start"
			res.modelArray = _root.startArray [_root.sedcardId];
			//res.attachMovie("sedcardBack","sedcardBack",3465)
		} else if (_root.currentDivision == "mainLB")
		{
			//trace("abab" + goingback)
			if (goingback)
			{
				if (_root.videoLetter == "All")
				{
					//_root.backLetter = "All";
					if (_root.videoSubdivision == "intown")
					{
						suff = "national";
					} else if (_root.videoSubdivision == "international" || _root.videoSubdivision == "newface" || _root.videoSubdivision.substr (0, 7) == "fashion" || _root.sedcardSubdivision.substr (0, 8) == "business" || _root.sedcardSubdivision.substr (0, 7) == "seniors" || _root.sedcardSubdivision.substr (0, 6) == "exotic" || _root.sedcardSubdivision.substr (0, 7) == "special" || _root.sedcardSubdivision.substr (0, 5) == "teens" || _root.sedcardSubdivision.substr (0, 6) == "actors" || _root.sedcardSubdivision == "women" || _root.sedcardSubdivision == "men" || _root.sedcardSubdivision.substr (0, 3) == "All")
					{
						suff = _root.videoSubdivision;
					} else
					{
						suff = "";
					}
					res.modelArray = _root.copyObject (_root [_root.videoDivision + suff + "Array"][_root.videoId]);
					//res.testvar = 1;
				} else
				{
					//_root.backLetter = _root.sedcardLetter;
					//trace("letter "+_root.sedcardLetter);
					//res.modelArray = _root.letterArray[_root.sedcardId];
					res.modelArray = copyObject (_root.letterArray [_root.videoId]);
				}
			} else
			{
				res.modelArray = _root.mainLBArray [_root.videoId];
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				if ( ! _root.appBusy)
				{
					_root.backHistory ();
					_root.unloadDivision ();
				}
			};
			addNextBtn ();
			//
			
		} else if (_root.currentDivision == "polaroids")
		{
			//trace("div:"+_root.polaroidsDivision);
			//trace("id:"+_root.polaroidsId);
			if (_root.polaroidsLetter == "All" || _root.polaroidsLetter == undefined)
			{
				if (_root.polaroidsSubdivision == "intown")
				{
					suff = "national";
				} else if (_root.polaroidsSubdivision == "international" || _root.polaroidsSubdivision == "newface" || _root.sedcardSubdivision == "fashion" || _root.sedcardSubdivision == "business" || _root.sedcardSubdivision == "seniors" || _root.sedcardSubdivision == "exotic" || _root.sedcardSubdivision == "specials" || _root.sedcardSubdivision == "teens" || _root.sedcardSubdivision == "actors")
				{
					suff = _root.polaroidsSubdivision;
				} else
				{
					suff = "";
				}
				res.modelArray = copyObject (_root [_root.polaroidsDivision + suff + "Array"][_root.polaroidsId]);
			} else
			{
				//trace("lett:"+_root.polaroidsLetter);
				//trace("id:"+_root.polaroidsId);
				res.modelArray = copyObject (_root.letterArray [_root.polaroidsId]);
			}
			if (sedcardDivision == "mainLB")
			{
				trace ("scdiv mainLB" + newline + mainLBArray)
				res.modelArray = _root.mainLBArray [_root.sedcardId];
			}
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				//_root.nextDivision = "back";
				//trace("sedcard div "+_root.sedcardDivision);
				//_root.backDivision = _root.sedcardDivision;
				//_root.backSubdivision = _root.sedcardSubdivision;
				//_root.backLetter = _root.sedcardLetter;
				//_root.backPage = _root.sedcardPage;
				trace ("back sc to pola");
				_root.backHistory ();
				_root.unloadDivision ();
			};
			addNextBtn ();
		} else if (_root.currentDivision == "search")
		{
			//_root.clearMenu();
			res.modelArray = copyObject (_root.searchArray [_root.videoId]);
			res.attachMovie ("sedcardBack", "sedcardBack", 3465);
			res.sedcardBack._x = 44;
			res.sedcardBack._y = 600;
			res.sedcardBack.onRelease = function ()
			{
				//_root.nextDivision = "back";
				//_root.backDivision = _root.sedcardDivision;
				//_root.backSubdivision = _root.sedcardSubdivision;
				//_root.backLetter = _root.sedcardLetter;
				_root.backHistory ();
				_root.unloadDivision ();
			};
			//addNextBtn ();
			
		}
		_root.currentDivision = _root.nextDivision;
	} else if (_root.nextDivision == "search")
	{
		res = _root.attachMovie ("search", "search1", 1000);
		res.modelArray = _root [_root.sedcardDivision + "Array"][_root.sedcardId];
		_root.currentDivision = _root.nextDivision;
		_root.currentSubdivision = "All";
	}
	//
	else if (_root.nextDivision == "agency")
	{
		_root.currentDivision = _root.nextDivision;
		_root.currentSubdivision = _root.nextSubdivision;
		_root.start1.removeMovieClip ();
		_root.division1.removeMovieClip ();
		_root.sedcard1.removeMovieClip ();
		res = _root.attachMovie ("agency", "agency1", 1000);
		//res.modelArray = _root[_root.sedcardDivision+"Array"][_root.sedcardId];
	}
	//SEC clear all nexts
	/*delete nextDivision;
	delete nextSubdivision;
	delete nextLetter;
	delete nextPage;*/
	goingback = false
	trace ("taksobietestuje3rootend")
}
/////////////
function searchandreplace (the_string, occurrences)
{
	//	äÄëËöÖüÜß
	replaceArray = new Array ("&auml;", "ä", "&Auml;", "Ä", "&euml;", "ë", "&Euml;", "Ë", "&ouml;", "ö", "&Ouml;", "Ö", "&uuml;", "ü", "&Uuml;", "Ü", "&szlig;", "ß", "&bdquo;", "\"", "&ldquo;", "\"", "<strong>", "<b>", "</strong>", "</b>", "<em>", "<i>", "</em>", "</i>", "../", "", "size=\"7\"", "size=\"36\"");
	//mytrace("len "+(replaceArray.length)/2);
	for (i = 0; i < replaceArray.length; i += 2)
	{
		//mytrace(i);
		search_string = replaceArray [i];
		replace_string = replaceArray [i + 1];
		var found = 0;
		var pos = the_string.indexOf (search_string);
		while (pos >= 0)
		{
			found ++;
			var start_string = the_string.substr (0, pos);
			var end_string = the_string.substr (pos + search_string.length);
			the_string = start_string + replace_string + end_string;
			pos = the_string.indexOf (search_string, pos + replace_string.length);
			if (found == occurrences)
			{
				pos = - 1;
			}
		}
	}
	return the_string;
}
/////////////////////////// SHAREDOBJECT //////////////////////////////
var liteboxSO : SharedObject = SharedObject.getLocal ("litebox");
//litebox_arr = new Array();
for (a in liteboxSO.data.litebox_arr)
{
	//trace(a+": "+liteboxSO.data.litebox_arr[a]);
	//litebox_arr[a]['model'] = liteboxSO.data.litebox_arr[a]['model']
	//litebox_arr[a]['picId'] = liteboxSO.data.litebox_arr[a]['picId']
	//litebox_arr[a]['picStamp'] = liteboxSO.data.litebox_arr[a]['picStamp']
}
//SEC addtolitebox
function addToLitebox (modelId, pictureId, pictureStamp, modelName)
{
	//trace("model: "+modelId+" pic: "+pictureId+" stamp: "+pictureStamp+"name: "+modelName);
	if (liteboxSO.data.litebox_arr == undefined)
	{
		liteboxSO.data.litebox_arr = new Array ();
	}
	var len = liteboxSO.data.litebox_arr.push (new Array (modelId, pictureId, pictureStamp, modelName));
	liteboxSO.flush ();
	if (_root.currentDivision == "sedcard")
	{
		_root.sedcard1.miniLB.totalLB = len;
		_root.sedcard1.miniLB.currentLB = len - 1;
		if (len > 5)
		{
			_root.sedcard1.miniLB.currSlide = len - 5;
			for (i = 0; i < len - 1; i ++)
			{
				//trace(i);
				//trace(_root.sedcard1.miniLB["miniLB1_"+i]);
				_root.sedcard1.miniLB ["miniLB1_" + i].xSlideTo ((i - len + 5) * 97 + 21, 1, "easeOutQuad");
				if (i == len - 2)
				{
					//trace("load new");
					_root.sedcard1.miniLB ["miniLB1_" + i].onTweenComplete = function ()
					{
						_root.sedcard1.miniLB.loadLB1 ();
					};
				}
			}
			//ladowanie
		} else
		{
			_root.sedcard1.miniLB.loadLB1 ();
		}
	}
	
	else if (_root.currentDivision == "videos")
	{
		_root.videos1.miniLB.totalLB = len;
		_root.videos1.miniLB.currentLB = len - 1;
		if (len > 5)
		{
			_root.videos1.miniLB.currSlide = len - 5;
			for (i = 0; i < len - 1; i ++)
			{
				//trace(i);
				//trace(_root.sedcard1.miniLB["miniLB1_"+i]);
				_root.videos1.miniLB ["miniLB1_" + i].xSlideTo ((i - len + 5) * 97 + 21, 1, "easeOutQuad");
				if (i == len - 2)
				{
					//trace("load new");
					_root.videos1.miniLB ["miniLB1_" + i].onTweenComplete = function ()
					{
						_root.videos1.miniLB.loadLB1 ();
					};
				}
			}
			//ladowanie
		} else
		{
			_root.videos1.miniLB.loadLB1 ();
		}
	}
	
	if (_root.currentDivision == "polaroids")
	{
		_root.polaroids1.miniLB.totalLB = len;
		_root.polaroids.miniLB.currentLB = len - 1;
		if (len > 5)
		{
			_root.polaroids1.miniLB.currSlide = len - 5;
			for (i = 0; i < len - 1; i ++)
			{
				//trace(i);
				//trace(_root.polaroids1.miniLB["miniLB1_"+i]);
				_root.polaroids1.miniLB ["miniLB1_" + i].xSlideTo ((i - len + 5) * 97 + 21, 1, "easeOutQuad");
				if (i == len - 2)
				{
					//trace("load new");
					_root.polaroids1.miniLB ["miniLB1_" + i].onTweenComplete = function ()
					{
						_root.polaroids1.miniLB.loadLB1 ();
					};
				}
			}
			//ladowanie
		} else
		{
			_root.polaroids1.miniLB.loadLB1 ();
		}
	}
}
/////////////////////////////////////////////////
function clearMainMenu ()
{
	switch (_root.currentDivision)
	{
		case "women" :
		selectedMenu = undefined;
		menu.item1.gotoAndStop (1);
		menu.item1.womenOn._alpha = 0;
		break;
		case "men" :
		selectedMenu = undefined;
		menu.item2.gotoAndStop (1);
		menu.item1.menOn._alpha = 0;
		break;
		case "people" :
		selectedMenu = undefined;
		menu.item3.gotoAndPlay (6);
		if (currentSubdivision == "fashion")
		{
			menu.itema.gotoAndPlay (6);
		} else if (currentSubdivision == "business")
		{
			menu.itemb.gotoAndPlay (6);
		} else if (currentSubdivision == "seniors")
		{
			menu.itemc.gotoAndPlay (6);
		} else if (currentSubdivision == "exotic")
		{
			menu.itemd.gotoAndPlay (6);
		} else if (currentSubdivision == "specials")
		{
			menu.iteme.gotoAndPlay (6);
		} else if (currentSubdivision == "teens")
		{
			menu.itemf.gotoAndPlay (6);
		} else if (currentSubdivision == "actors")
		{
			menu.itemg.gotoAndPlay (6);
		} else if (currentSubdivision == "women")
		{
			menu.itemh.gotoAndPlay (6);
		} else if (currentSubdivision == "men")
		{
			menu.itemi.gotoAndPlay (6);
		}
		break;
		case "search" :
		selectedMenu = undefined;
		menu.item7.gotoAndPlay (6);
		break;
		default :
		//trace("jakis inny division");
		break;
	}
}
////////////////// printPhoto
function printPhoto (myStamp)
{
	//trace(myStamp);
	_root.attachMovie ("printingPhoto", "printingPhoto", 3817);
	_root.createEmptyMovieClip ("loadedPhoto", 3818);
	loadedPhoto._alpha = 0;
	//loadedPhoto._x = 20
	//loadedPhoto._y = 20
	loadedPhotoL = new Object ();
	loadedPhotoL.onLoadComplete = function ()
	{
		printInt = setInterval (printPhoto2, 500, myStamp);
	};
	loadedPhotoMCL = new MovieClipLoader ();
	loadedPhotoMCL.addListener (loadedPhotoL);
	loadedPhotoMCL.loadClip ("http://fotogen.ch/images/print/" + myStamp + "_print.jpg", _root.loadedPhoto);
}
function printPhoto2 (myStamp)
{
	//trace(myStamp);
	if (printingPhoto._currentframe == 10)
	{
		clearInterval (printInt);
		pj = new PrintJob ();
		success = pj.start ();
		if (success)
		{
			//trace("paper height: "+pj.paperHeight+newline+"paper width: "+pj.paperWidth+newline+"page h: "+pj.pageHeight+newline+"page w: "+pj.pageWidth+newline+"orient: "+pj.orientation);
			//trace("photo w:"+loadedPhoto._width+newline+"photo h: "+loadedPhoto._height);
			if (pj.pageWidth < loadedPhoto._width || pj.pageHeight < loadedPhoto._height)
			{
				if (loadedPhoto._width / pj.pageWidth > loadedPhoto._height / pj.pageHeight)
				{
					multi = pj.pageWidth / loadedPhoto._width;
				} else
				{
					multi = pj.pageHeight / loadedPhoto._height;
				}
				//trace("multi "+multi);
				loadedPhoto._width *= multi;
				loadedPhoto._height *= multi;
			} else
			{
				multi = 1;
			}
			loadedPhoto._x = Math.round ((pj.pageWidth - loadedPhoto._width) / 2);
			loadedPhoto._y = Math.round ((pj.pageHeight - loadedPhoto._height) / 2);
			loadedPhoto._alpha = 100;
			pj.addPage (loadedPhoto,
			{
				xMin : - loadedPhoto._x, xMax : loadedPhoto._width / multi, yMin : - loadedPhoto._y, yMax : loadedPhoto._height / multi
			});
			///     pj.addPage("mc", {xMin : -300, xMax: 300, yMin: 400, yMax: 800});
			pj.send ();
		}
		printingPhoto.gotoAndPlay (11);
		delete pj;
		loadedPhoto.removeMovieClip ();
		_root.unblockApp ();
	}
}
/////////////////////////////////
function printPort ()
{
	//trace(myStamp);
	_root.attachMovie ("printingPhoto", "printingPhoto", 3817);
	//_root.createEmptyMovieClip("loadedPort", 3818);
	res = _root.attachMovie ("printPort_mc", "printPort_mc", 3818);
	res._alpha = 0;
	res.modelArray = _root.portArray;
}
function printPort2 ()
{
	pj = new PrintJob ();
	success = pj.start ();
	if (success)
	{
		//trace("paper height: "+pj.paperHeight+newline+"paper width: "+pj.paperWidth+newline+"page h: "+pj.pageHeight+newline+"page w: "+pj.pageWidth+newline+"orient: "+pj.orientation);
		//trace("photo w:"+printPort_mc._width+newline+"photo h: "+printPort_mc._height);
		if (pj.pageWidth < printPort_mc._width || pj.pageHeight < printPort_mc._height)
		{
			if (printPort_mc._width / pj.pageWidth > printPort_mc._height / pj.pageHeight)
			{
				multi = pj.pageWidth / printPort_mc._width;
			} else
			{
				multi = pj.pageHeight / printPort_mc._height;
			}
			//trace("multi "+multi);
			printPort_mc._width *= multi;
			printPort_mc._height *= multi;
		} else
		{
			multi = 1;
		}
		printPort_mc._alpha = 100;
		pj.addPage (printPort_mc,
		{
			xMin : 0, xMax : printPort_mc._width / multi, yMin : - 10, yMax : printPort_mc._height / multi + 10
		});
		printPort_mc._alpha = 0;
		pj.send ();
	}
	delete pj;
	printingPhoto.gotoAndPlay (11);
	printPort_mc.removeMovieClip ();
	_root.unblockApp ();
}
/////////////////// DOWNLOAD PDF
function downloadPdf (mypdf)
{
	getURL ("http://fotogen.ch/download.php?file=pdf/" + mypdf);
}
// DOWNLOAD PDFS
function downloadPdfs ()
{
	for (i = 0; i < _root.mainLBArray.length; i ++)
	{
		if (_root.mainLBArray [i]['pdf_file'] != "none")
		{
			_root ["myint" + i] = setInterval (downloadPdf2, 2000 * i, i, _root.mainLBArray [i]['pdf_file']);
			//getURL("http://fotogen.ch/download.php?file=pdf/"+_root.mainLBArray[i]['pdf_file'],"window"+i);
		}
	}
}
function downloadPdf2 (param, param2)
{
	//trace(param);
	clearInterval (_root ["myint" + param]);
	getURL ("http://fotogen.ch/download.php?file=pdf/" + param2);
}
/*function downloadPdfs() {
suff = "";
for (i=0; i<_root.mainLBArray.length; i++) {
if (_root.mainLBArray[i]['pdf_file'] != "none") {
suff += "pdfs[]="+_root.mainLBArray[i]['pdf_file']+"&";
}

}
trace(suff);
getURL("http://fotogen.ch/download.php?"+suff);

}*/
//////////////////////////////////// BLOCK
blockApp ();
function blockApp ()
{
	appBusy = true;
	if (currentDivision == "start")
	{
		for (i = 0; i < 12; i ++)
		{
			_root.start1 ["startPic" + i].butSmall.enabled = false;
		}
	} else if (currentDivision == "women" || currentDivision == "men" || currentDivision == "people")
	{
		for (i = 0; i < 12; i ++)
		{
			_root.division1 ["startPic" + i].butSmall.enabled = false;
		}
	} else if (currentDivision == "sedcard")
	{
		_root.sedcard1.bigPic1.butSmall.enabled = false;
		for (i = 0; i < 4; i ++)
		{
			_root.sedcard1 ["startPic" + i].butSmall.enabled = false;
		}
	} else if (currentDivision == "mainLB")
	{
		for (i = 0; i <= _root.mainLB1.current; i ++)
		{
			_root.mainLB1 ["mainLBpic" + i].butSmall.enabled = false;
		}
	} else if (currentDivision == "polaroids")
	{
		for (i = 0; i < 6; i ++)
		{
			_root.polaroids1 ["polaPic" + i].butSmall.enabled = false;
		}
	}
}
function unblockApp ()
{
	//trace("unblock APP");
	//trace(arguments.caller);
	appBusy = false;
	if (currentDivision == "start")
	{
		for (i = 0; i < 12; i ++)
		{
			_root.start1 ["startPic" + i].butSmall.enabled = true;
		}
	} else if (currentDivision == "women" || currentDivision == "men" || currentDivision == "people")
	{
		for (i = 0; i < 12; i ++)
		{
			_root.division1 ["startPic" + i].butSmall.enabled = true;
		}
	} else if (currentDivision == "sedcard")
	{
		_root.sedcard1.bigPic1.butSmall.enabled = true;
		for (i = 0; i < 4; i ++)
		{
			_root.sedcard1 ["startPic" + i].butSmall.enabled = true;
		}
	} else if (currentDivision == "mainLB")
	{
		for (i = 0; i <= _root.mainLB1.current; i ++)
		{
			_root.mainLB1 ["mainLBpic" + i].butSmall.enabled = true;
		}
	} else if (currentDivision == "polaroids")
	{
		for (i = 0; i < 6; i ++)
		{
			_root.polaroids1 ["polaPic" + i].butSmall.enabled = true;
		}
	}
}
//////////////////////
function showHelp ()
{
	_root.blockApp ();
	_root.createEmptyMovieClip ("help1", 5000);
	_root.help1.createEmptyMovieClip ("helpPhoto", 100);
	_root.help1.helpPhoto._alpha = 0;
	_root.help1.attachMovie ("loader", "loader", 200);
	_root.help1.loader._x = 412;
	_root.help1.loader._y = 320;
	helpL = new Object ();
	helpL.onLoadInit = function (tar_mc)
	{
		//trace("682");
		_root.help1.helpPhoto._x = 174;
		_root.help1.helpPhoto._y = 65;
		_root.help1.helpMask._x = 174;
		_root.help1.helpMask._y = 65;
		_root.help1.helpBG._x = 164;
		_root.help1.helpBG._y = 45;
	};
	helpL.onLoadComplete = function ()
	{
		_root.help1.attachMovie ("helpMask", "helpMask", 300);
		_root.help1.attachMovie ("helpBG", "helpBG", 99);
		_root.help1.helpBG._alpha = 0;
		_root.help1.helpBG.alphaTo (100, 0.5, "linear");
		_root.help1.helpBG.onTweenComplete = function ()
		{
			_root.help1.helpPhoto.alphaTo (100, 0.5, "linear");
		};
		_root.help1.helpPhoto.setMask (_root.help1.helpMask);
		_root.help1.helpPhoto.onMouseMove = function ()
		{
			myMouse = _root._ymouse - 65;
			//trace("ymouse"+myMouse);
			if (myMouse > 0 && myMouse < 605)
			{
				//newY = -((myMouse)/this._height)*(this._height-605)+65;
				newY = - ((myMouse) / 605) * (this._height - 605) + 65;
				this.ySlideTo (newY, 1, "easeOutQuad");
			}
		};
		_root.help1.loader.alphaTo (0, 0.5, "linear");
	};
	helpL.onLoadProgress = function (tar_mc, bL, bT)
	{
		_root.help1.loader.bar._xscale = Math.round (bL * 100 / bT);
	};
	helpMCL = new MovieClipLoader ();
	helpMCL.addListener (helpL);
	helpMCL.loadClip (imghost + "gfx/instructions.jpg", help1.helpPhoto);
}
////////////////////////////////////////////////////////////////////
function zoomPhoto (myStamp)
{
	_root.blockApp ();
	_root.createEmptyMovieClip ("zoom", 5000);
	_root.zoomStamp = myStamp;
	_root.zoom.createEmptyMovieClip ("zoomPhoto", 100);
	_root.zoom.zoomPhoto._alpha = 0;
	_root.zoom.attachMovie ("loader", "loader", 200);
	_root.zoom.loader._x = 412;
	_root.zoom.loader._y = 320;
	zoomL = new Object ();
	zoomL.onLoadInit = function (tar_mc)
	{
		if (tar_mc._width == 605)
		{
			//trace("605");
			_root.zoom.zoomPhoto._x = 174;
			_root.zoom.zoomPhoto._y = 65;
			_root.zoom.zoomMask._x = 174;
			_root.zoom.zoomMask._y = 65;
			_root.zoom.zoomBG._x = 164;
			_root.zoom.zoomBG._y = 45;
		} else
		{
			_root.zoom.zoomPhoto._x = 41;
			_root.zoom.zoomPhoto._y = 64;
			delete _root.zoom.zoomPhoto.onMouseMove;
			_root.zoom.zoomBG.gotoAndStop (2);
			_root.zoom.zoomPhoto.setMask (null);
			_root.zoom.zoomMask.removeMovieClip ();
			_root.zoom.zoomBG._x = 32;
			_root.zoom.zoomBG._y = 45;
		}
	};
	zoomL.onLoadComplete = function ()
	{
		_root.zoom.attachMovie ("zoomMask", "zoomMask", 300);
		_root.zoom.attachMovie ("zoomBG", "zoomBG", 99);
		_root.zoom.zoomBG._alpha = 0;
		_root.zoom.zoomBG.alphaTo (100, 0.5, "linear");
		_root.zoom.zoomBG.onTweenComplete = function ()
		{
			_root.zoom.zoomPhoto.alphaTo (100, 0.5, "linear");
		};
		_root.zoom.zoomPhoto.setMask (_root.zoom.zoomMask);
		_root.zoom.zoomPhoto.onMouseMove = function ()
		{
			myMouse = this._ymouse;
			//trace(myMouse);
			if (myMouse > 0 && myMouse < this._height)
			{
				newY = - ((myMouse) / this._height) * (this._height - 605) + 65;
				this.ySlideTo (newY, 1, "easeOutQuad");
			}
		};
		_root.zoom.loader.alphaTo (0, 0.5, "linear");
	};
	zoomL.onLoadProgress = function (tar_mc, bL, bT)
	{
		_root.zoom.loader.bar._xscale = Math.round (bL * 100 / bT);
	};
	zoomMCL = new MovieClipLoader ();
	zoomMCL.addListener (zoomL);
	zoomMCL.loadClip ("http://fotogen.ch/images/print/" + myStamp + "_print.jpg", zoom.zoomPhoto);
}
function savePhoto ()
{
	getURL ("http://fotogen.ch/savephoto.php?file=images/print/" + _root.zoomStamp + "_print.jpg");
}
///////////////////////////////
function copyObject (obj)
{
	// create a "new" object or array depending on the type of obj
	var copy = (obj instanceof Array) ? [] :
	{
	};
	// loop over all of the value in the object or the array to copy them
	for (var i in obj)
	{
		// assign a temporarity value for the data inside the object
		var item = obj [i];
		// check to see if the data is complex or primitive
		switch (item instanceof Array || item instanceof Object)
		{
			case true :
			// if the data inside of the complex type is still complex, we need to
			// break that down further, so call copyObject again on that complex
			// item
			copy [i] = copyObject (item);
			break;
			default :
			// the data inside is primitive, so just copy it (this is a value copy)
			copy [i] = item;
		}
	}
	return copy;
}
//////////////////////////////////
function addNextBtn ()
{
	res.attachMovie ("sedcardNext", "sedcardNext", 3466);
	res.sedcardNext._x = 244;
	res.sedcardNext._y = 600;
	res.sedcardNext.onRelease = function ()
	{
		if (_root.sedcardLetter == "All")
		{
			//_root.backLetter = "All";
			if (_root.sedcardSubdivision == "intown")
			{
				suff = "national";
			} else if (_root.sedcardSubdivision == "international" || _root.sedcardSubdivision == "newface" || _root.sedcardSubdivision.substr (0, 7) == "fashion" || _root.sedcardSubdivision.substr (0, 8) == "business" || _root.sedcardSubdivision.substr (0, 7) == "seniors" || _root.sedcardSubdivision.substr (0, 6) == "exotic" || _root.sedcardSubdivision.substr (0, 7) == "special" || _root.sedcardSubdivision.substr (0, 5) == "teens" || _root.sedcardSubdivision.substr (0, 6) == "actors" || _root.sedcardSubdivision.substr (0, 3) == "All")
			{
				suff = _root.sedcardSubdivision;
			} else
			{
				suff = "";
			}
			len = _root [_root.sedcardDivision + suff + "Array"].length;
		} else
		{
			len = _root.letterArray.length;
		}
		//trace("len "+len);
		//trace(_root.sedcardLetter);
		//trace(suff);
		//trace(_root.sedcardDivision);
		if (_root.sedcardId < len - 1 && ! _root.appBusy)
		{
			_root.blockApp ();
			this._parent.slider.alphaTo (0, 0.5, "linear");
			this._parent.descSedCard.alphaTo (0, 0.5, "linear");
			for (i = 3; i >= 0; i --)
			{
				this._parent ["startPic" + i].mirror._alpha = 0;
				this._parent ["startPic" + i].alphaTo (0, 0.5, "linear", 0.2 * (3 - i));
				this._parent ["startPic" + i].onTweenComplete = function ()
				{
					this.removeMovieClip ();
				};
			}
			this._parent.bigPic1.mirror._alpha = 0;
			this._parent.bigPic1.alphaTo (0, 0.5, "linear", 0.8);
			this._parent.bigPic1.onTweenComplete = function ()
			{
				//trace("SCID "+_root.sedcardId);
				_root.sedcardId ++;
				if (_root.sedcardLetter == "All")
				{
					//_root.backLetter = "All";
					if (_root.sedcardSubdivision == "intown")
					{
						suff = "national";
					} else if (_root.sedcardSubdivision == "international" || _root.sedcardSubdivision == "newface" || _root.sedcardSubdivision.substr (0, 7) == "fashion" || _root.sedcardSubdivision.substr (0, 8) == "business" || _root.sedcardSubdivision.substr (0, 7) == "seniors" || _root.sedcardSubdivision.substr (0, 6) == "exotic" || _root.sedcardSubdivision.substr (0, 7) == "special" || _root.sedcardSubdivision.substr (0, 5) == "teens" || _root.sedcardSubdivision.substr (0, 6) == "actors" || _root.sedcardSubdivision.substr (0, 3) == "All")
					{
						suff = _root.sedcardSubdivision;
					} else
					{
						suff = "";
					}
					//trace("suff "+suff);
					//trace("scDiv "+_root.sedcardDivision);
					this._parent.modelArray = _root.copyObject (_root [_root.sedcardDivision + suff + "Array"][_root.sedcardId]);
				} else
				{
					//_root.backLetter = _root.sedcardLetter;
					//trace("letter "+_root.sedcardLetter);
					//res.modelArray = _root.letterArray[_root.sedcardId];
					this._parent.modelArray = _root.copyObject (_root.letterArray [_root.sedcardId]);
				}
				this._parent.newXMLloaded = true;
				for (i = 0; i < this._parent.modelArray ['images'].length; i ++)
				{
					if (this._parent.modelArray ['images'][i]['sed_card'] == '1')
					{
						picId = this._parent.modelArray ['images'][i]['id'];
					}
				}
				this._parent.newPlay (picId);
			};
			//ontweencomplete
		}
	};
	//on release
}
//add btn
/////////////////////////////////
function rememberMenu ()
{
	_root.backMenu = _root.selectedMenu;
}
function setBackMenu ()
{
	//trace("curr menu "+_root.currentMenu);
	if (_root.selectedMenu == 4)
	{
		_root.menu.item4.agencyOn.alphaTo (0, 0.5, "linear");
	}
	if (_root.selectedMenu == 5)
	{
		_root.menu.item5.gotoAndPlay (6);
	}
	if (_root.selectedMenu == 6)
	{
		_root.menu.item6.faqOn.alphaTo (0, 0.5, "linear");
	}
	if (_root.selectedMenu == 8)
	{
		_root.menu.item8.contactOn.alphaTo (0, 0.5, "linear");
	}
	if (_root.selectedMenu == 9)
	{
		//trace("sel menu 9")
		//trace("frame" + _root.menu.item9._currentframe)
		_root.menu.item9.helpOn.alphaTo (0, 0.5, "linear");
		_root.menu.item9.gotoAndPlay (6);
	}
	//
	if (_root.backMenu == 1)
	{
		_root.menu.item1.womenOn.alphaTo (100, 0.5, "linear");
	}
	if (_root.backMenu == 2)
	{
		_root.menu.item2.menOn.alphaTo (100, 0.5, "linear");
	}
	if (_root.backMenu == 3)
	{
		_root.menu.item3.peopleOn.alphaTo (100, 0.5, "linear");
	}
	if (_root.backMenu == 7)
	{
		_root.menu.item7.gotoAndPlay (2);
	}
	if (_root.backMenu == "a")
	{
		_root.menu.itema.gotoAndPlay (2);
	}
	if (_root.backMenu == "b")
	{
		_root.menu.itemb.gotoAndPlay (2);
	}
	if (_root.backMenu == "c")
	{
		_root.menu.itemc.gotoAndPlay (2);
	}
	if (_root.backMenu == "d")
	{
		_root.menu.itemd.gotoAndPlay (2);
	}
	if (_root.backMenu == "e")
	{
		_root.menu.iteme.gotoAndPlay (2);
	}
	if (_root.backMenu == "f")
	{
		_root.menu.itemf.gotoAndPlay (2);
	}
	if (_root.backMenu == "g")
	{
		_root.menu.itemg.gotoAndPlay (2);
	}
	if (_root.backMenu == "h")
	{
		_root.menu.itemh.gotoAndPlay (2);
	}
	if (_root.backMenu == "i")
	{
		_root.menu.itemi.gotoAndPlay (2);
	}
	_root.selectedMenu = _root.backMenu;
}
//SEC add history
function addHistory ()
{
	if (historyArray == undefined)
	{
		historyArray = new Array ();
	}
	if (currentDivision == "women" || currentDivision == "men" || currentDivision == "people")
	{
		tempHist = new Array ();
		tempHist ['division'] = currentDivision;
		tempHist ['subdivision'] = currentSubdivision;
		tempHist ['page'] = division1.currentPage;
		tempHist ['letter'] = division1.currentLetter;
		historyArray.push (tempHist);
	} else if (currentDivision == "sedcard")
	{
		tempHist = new Array ();
		tempHist ['division'] = currentDivision;
		tempHist ['sedcarddivision'] = sedcardDivision;
		tempHist ['sedcardsubdivision'] = sedcardSubdivision;
		tempHist ['sedcardid'] = sedcardId;
		tempHist ['sedcardletter'] = sedcardLetter;
		historyArray.push (tempHist);
	} else if (currentDivision == "videos")
	{
		tempHist = new Array ();
		tempHist ['division'] = currentDivision;
		/*tempHist ['videosdivision'] = sedcardDivision;
		tempHist ['videossubdivision'] = sedcardSubdivision;
		tempHist ['videosid'] = sedcardId;
		tempHist ['videosletter'] = sedcardLetter;*/
		tempHist ['videosdivision'] = videoDivision;
		tempHist ['videossubdivision'] = videoSubdivision;
		tempHist ['videosid'] = videoId;
		tempHist ['videosletter'] = videoLetter;
		historyArray.push (tempHist);
	} else if (currentDivision == "search")
	{
		tempHist = new Array ();
		tempHist ['division'] = currentDivision;
		historyArray.push (tempHist);
	} else if (currentDivision == "polaroids")
	{
		tempHist = new Array ();
		tempHist ['division'] = currentDivision;
		tempHist ['polaroidsdivision'] = polaroidsDivision;
		tempHist ['polaroidssubdivision'] = polaroidsSubdivision;
		tempHist ['polaroidsid'] = polaroidsId;
		tempHist ['polaroidsletter'] = polaroidsLetter;
		historyArray.push (tempHist);
	} else if (currentDivision == "mainLB")
	{
		tempHist = new Array ();
		tempHist ['division'] = currentDivision;
		historyArray.push (tempHist);
	}
	/*else if (currentDivision == "mainLB") {
	tempHist = new Array();
	tempHist['division']=currentDivision;
	tempHist['lbpage']=mainLB1.currentPage;
	historyArray.push(tempHist);
	}*/
}
//SEC backhistory
//////////////////////
function backHistory ()
{
	goingback = true;
	backArray = historyArray.pop ();
	//trace("backarray['division']"+backArray['division'])
	if (backArray ['division'] == "women" || backArray ['division'] == "men" || backArray ['division'] == "people")
	{
		nextDivision = backArray ['division'];
		nextSubdivision = backArray ['subdivision'];
		nextLetter = backArray ['letter'];
		nextPage = backArray ['page']
	} else if (backArray ['division'] == "search")
	{
		nextDivision = backArray ['division'];
	} else if (backArray ['division'] == "sedcard")
	{
		nextDivision = backArray ['division'];
		sedcardDivision = backArray ['sedcarddivision'];
		sedcardSubdivision = backArray ['sedcardsubdivision'];
		sedcardId = backArray ['sedcardid'];
		sedcardLetter = backArray ['sedcardletter'];
	} else if (backArray ['division'] == "videos")
	{
		nextDivision = backArray ['division'];
		trace("curr div:"+currentDivision);
		trace("next div:"+nextDivision);
		videoDivision = backArray ['videosdivision'];
		trace("videoDivision:"+videoDivision);
		videoSubdivision = backArray ['videossubdivision'];
		trace("videoSubdivision:"+videoSubdivision);
		videoId = backArray ['videosid'];
		trace("videoId:"+videoId);
		videoLetter = backArray ['videosletter'];
		trace("videoLetter:"+videoLetter);
	} else if (backArray ['division'] == "polaroids")
	{
		nextDivision = backArray ['division'];
		polaroidsDivision = backArray ['polaroidsdivision'];
		polaroidsSubdivision = backArray ['polaroidssubdivision'];
		polaroidsId = backArray ['polaroidsid'];
		polaroidsLetter = backArray ['polaroidsletter'];
	} else if (backArray ['division'] == "mainLB")
	{
		nextDivision = backArray ['division']
	}
}
////////////////////////////SEC checkCaller
function checkCaller (target, caller)
{
	for (var i in target)
	{
		if (caller == target [i])
		{
			trace ("znalazl");
			trace (target + " " + i);
		} else
		{
			checkCaller (target [i] , caller);
		}
	}
}
////////////////////////////////
mainLBXML = new XML ();
mainLBXML.ignoreWhite = true;
function parsemainLBXML (success)
{
	if (success)
	{
		mainLBNode = this.firstChild.firstChild;
		len = mainLBNode.childNodes.length;
		mainLBArray = new Array ();
		for (i = 0; i < len; i ++)
		{
			//trace(mainLBNode.childNodes[i]);
			mainLBArray [i] = new Array ();
			mainLBArray [i]['id'] = mainLBNode.childNodes [i].childNodes [0].firstChild.nodeValue;
			mainLBArray [i]['national'] = mainLBNode.childNodes [i].childNodes [1].firstChild.nodeValue;
			mainLBArray [i]['date_entry'] = mainLBNode.childNodes [i].childNodes [2].firstChild.nodeValue;
			mainLBArray [i]['date_last_changed'] = mainLBNode.childNodes [i].childNodes [3].firstChild.nodeValue;
			mainLBArray [i]['active'] = mainLBNode.childNodes [i].childNodes [4].firstChild.nodeValue;
			mainLBArray [i]['first_name'] = mainLBNode.childNodes [i].childNodes [5].firstChild.nodeValue;
			mainLBArray [i]['last_name'] = mainLBNode.childNodes [i].childNodes [6].firstChild.nodeValue;
			mainLBArray [i]['nick_name'] = mainLBNode.childNodes [i].childNodes [7].firstChild.nodeValue;
			mainLBArray [i]['height'] = mainLBNode.childNodes [i].childNodes [8].firstChild.nodeValue;
			mainLBArray [i]['chest'] = mainLBNode.childNodes [i].childNodes [9].firstChild.nodeValue;
			mainLBArray [i]['waist'] = mainLBNode.childNodes [i].childNodes [10].firstChild.nodeValue;
			mainLBArray [i]['hips'] = mainLBNode.childNodes [i].childNodes [11].firstChild.nodeValue;
			mainLBArray [i]['size'] = mainLBNode.childNodes [i].childNodes [12].firstChild.nodeValue;
			mainLBArray [i]['shoes'] = mainLBNode.childNodes [i].childNodes [13].firstChild.nodeValue;
			mainLBArray [i]['eyes'] = mainLBNode.childNodes [i].childNodes [14].firstChild.nodeValue;
			mainLBArray [i]['hair'] = mainLBNode.childNodes [i].childNodes [15].firstChild.nodeValue;
			mainLBArray [i]['images1'] = mainLBNode.childNodes [i].childNodes [16].firstChild.nodeValue;
			mainLBArray [i]['images2'] = mainLBNode.childNodes [i].childNodes [17].firstChild.nodeValue;
			mainLBArray [i]['movies'] = mainLBNode.childNodes [i].childNodes [18].firstChild.nodeValue;
			mainLBArray [i]['start_page_flag'] = mainLBNode.childNodes [i].childNodes [19].firstChild.nodeValue;
			mainLBArray [i]['new_face_flag'] = mainLBNode.childNodes [i].childNodes [20].firstChild.nodeValue;
			mainLBArray [i]['sed_card_big_image_flag'] = mainLBNode.childNodes [i].childNodes [21].firstChild.nodeValue;
			mainLBArray [i]['category'] = mainLBNode.childNodes [i].childNodes [22].firstChild.nodeValue;
			mainLBArray [i]['man_woman'] = mainLBNode.childNodes [i].childNodes [23].firstChild.nodeValue;
			mainLBArray [i]['pdf_file'] = mainLBNode.childNodes [i].childNodes [24].firstChild.nodeValue;
			mainLBArray [i]['images'] = new Array ();
			mainLBArray [i]['polas'] = new Array ();
			len2 = mainLBNode.childNodes [i].childNodes [25].childNodes.length;
			k = 0;
			for (j = 0; j < len2; j ++)
			{
				mainLBArray [i]['images'][j] = new Array ();
				//trace(mainLBNode.childNodes[i].childNodes[24].childNodes[j].childNodes[0].firstChild.nodeValue);
				mainLBArray [i]['images'][j]['id'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [0].firstChild.nodeValue;
				mainLBArray [i]['images'][j]['stamp'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [1].firstChild.nodeValue;
				mainLBArray [i]['images'][j]['model_id'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [2].firstChild.nodeValue;
				mainLBArray [i]['images'][j]['start_page'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [3].firstChild.nodeValue;
				mainLBArray [i]['images'][j]['sed_card'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [4].firstChild.nodeValue;
				mainLBArray [i]['images'][j]['new_face'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [5].firstChild.nodeValue;
				mainLBArray [i]['images'][j]['polaroid'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [6].firstChild.nodeValue;
				if (mainLBArray [i]['images'][j]['polaroid'] == "1")
				{
					mainLBArray [i]['polas'][k] = new Array ();
					mainLBArray [i]['polas'][k]['id'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [0].firstChild.nodeValue;
					mainLBArray [i]['polas'][k]['stamp'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [1].firstChild.nodeValue;
					mainLBArray [i]['polas'][k]['model_id'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [2].firstChild.nodeValue;
					mainLBArray [i]['polas'][k]['start_page'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [3].firstChild.nodeValue;
					mainLBArray [i]['polas'][k]['sed_card'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [4].firstChild.nodeValue;
					mainLBArray [i]['polas'][k]['new_face'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [5].firstChild.nodeValue;
					mainLBArray [i]['polas'][k]['polaroid'] = mainLBNode.childNodes [i].childNodes [25].childNodes [j].childNodes [6].firstChild.nodeValue;
					k ++;
				}
			}
		}
		/*_root.mainLBArray = new Array();
		for (i=0; i<_root.mainLB1.mainLBArray.length; i++) {
		_root.mainLBArray[i] = _root.mainLB1.mainLBArray[i];
		}
		loadPic();
		setSlider();*/
	} else 
	{
		trace ("nie zaladowal");
	}
}
mainLBXML.onLoad = parsemainLBXML;
len = _root.liteboxSO.data.litebox_arr.length;
suff = "?ids=";
for (i = 0; i < len; i ++)
{
	suff += _root.liteboxSO.data.litebox_arr [i][0] + ",";
}
//trace(suff);
mainLBXML.load ("http://fotogen.ch/getmainlbxml.php" + suff);
