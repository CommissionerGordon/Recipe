using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Recipe_WebScraper
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void urlTextBox_TextChanged(object sender, EventArgs e)
        {
            //get text written in text box as an url
            string url = urlTextBox.Text;
            //use url to get the website's source code
            string sourceCode = WebScraper.getSourceCode(url);
            //write the sourceCode to a file
            StreamWriter streamWrite = new StreamWriter("website.txt");
            streamWrite.Write(sourceCode);
            streamWrite.Close();
        }
    }
}
