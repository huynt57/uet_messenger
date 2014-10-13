<?php
class MyLinkPager extends CLinkPager {
	
	public function run()
	{
		//
			// here we call our createPageButtons
			//
			$buttons=$this->createPageButtons();
			//
			// if there is nothing to display return
			if(empty($buttons))
			return;
			//
			// display the buttons
			//
			echo $this->header; // if any
			echo implode("&nbsp;",$buttons);
			echo $this->footer;  // if any
	}
	
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		//
			// CSS_HIDDEN_PAGE and CSS_SELECTED_PAGE
			// are constants that we use to apply our styles
			//
			if($hidden || $selected)
			$class=' '.($hidden ? 'disabled' : 'active');
			$class .= ' paging-number';
			//
			// here I write my custom link - site.call is a JS function that takes care of an AJAX call
			//
			return CHtml::link($label,'javascript:void(0);',array(
			'class'=>$class,
			'pagenumber'=>$page,
			'onclick'=>"site.call(CONST_MAIN_LAYER,'{$this->createPageUrl($this->getController(),$page)}');"));
	}
	
	public function createPageUrl($controller,$page)
	{
		// HERE I USE POST AS I DO AJAX CALLS VIA POST NOT GET AS IT IS BY
		// DEFAULT ON YII
		$params=$this->getPages()->params===null ? $_POST : $this->getPages()->params;
		if($page>0) // page 0 is the default
			$params[$this->getPages()->pageVar]=$page+1;
		else
			unset($params[$this->getPages()->pageVar]);
		return $controller->createUrl($this->getPages()->route,$params);
	}
}