
  
  wp.hooks.addFilter(
  'blocks.registerBlockType',
  'awp/spacer-background-attribute',
  addSpacerAttributes);
  
  const spacerInspectorControls = wp.compose.compose(
  
  wp.blockEditor.withColors({ backgroundColor: 'background-color' }),
  
  wp.compose.createHigherOrderComponent(BlockEdit => {
    return props => {
  
      if (props.name !== 'core/spacer') {
        return /*#__PURE__*/React.createElement(BlockEdit, props);
      }
  
      const { Fragment } = wp.element;
      const { InspectorControls, PanelColorSettings } = wp.blockEditor;
      const { attributes, setAttributes, isSelected } = props;
      const { backgroundColor, setBackgroundColor } = props;
  
      let newClassName = attributes.className != undefined ? attributes.className : '';
      let newStyles = { ...props.style };
      if (backgroundColor != undefined) {
        if (backgroundColor.class == undefined) {
          newStyles.backgroundColor = backgroundColor.color;
        } else {
          newClassName += ' ' + backgroundColor.class;
        }
      }
  
      const newProps = {
        ...props,
        attributes: {
          ...attributes,
          className: newClassName },
  
        style: newStyles };
  
  
      return /*#__PURE__*/(
        React.createElement(Fragment, null, /*#__PURE__*/
        React.createElement("div", { style: newStyles, className: newClassName }, /*#__PURE__*/
        React.createElement(BlockEdit, newProps),
        isSelected && props.name == 'acf/supply-separator-block' && /*#__PURE__*/
        React.createElement(InspectorControls, null, /*#__PURE__*/
        React.createElement(PanelColorSettings, {
          title: wp.i18n.__('Color Settings', 'awp'),
          colorSettings: [
          {
            value: backgroundColor.color,
            onChange: setBackgroundColor,
            label: wp.i18n.__('Background color', 'awp') }] })))));
  
  
  
  
  
  
  
  
    };
  }, 'spacerInspectorControls'));
  
  wp.hooks.addFilter(
  'editor.BlockEdit',
  'awp/spacer-inspector-control',
  spacerInspectorControls);
  function addSpacerAttributes(settings, name) {
      if (typeof settings.attributes !== 'undefined') {
        if (name == 'acf/supply-separator-block') {
          settings.attributes = Object.assign(settings.attributes, {
            backgroundColor: {
              type: 'string' },
    
            customBackgroundColor: {
              type: 'string' } });
    
    
        }
      }
      return settings;
    }