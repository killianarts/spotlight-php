import {html, css, LitElement} from 'https://cdn.jsdelivr.net/gh/lit/dist@3.2.1/all/lit-all.min.js';

export class ShisoElement extends LitElement {
  static styles = css`
button, input, select, optgroup, textarea, ::file-selector-button {
    font: inherit;
    font-feature-settings: inherit;
    font-variation-settings: inherit;
    letter-spacing: inherit;
    color: inherit;
    border-radius: 0;
    background-color: var(--color-blue-50);
    opacity: 1;
}
`
}

export class FormField extends ShisoElement {
  static properties = {
    name: {type: String},
    type: {type: String},
  }

  constructor() {
    super();
    this.type = "text"
  }

  render() {
    return html`
<input name="${this.name}" type="${this.type}" />
`;
  }
}
customElements.define('shiso-field', FormField);
