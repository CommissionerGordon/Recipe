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
        // This just changes the title of the form.
        private void urlTextBox_TextChanged(object sender, EventArgs e)
        {
            if (urlTextBox.Text == "http://csc413-recipefinal.rhcloud.com/ScraperTestPage.html")
                this.Text = "Scraper Test Page";
            else
                this.Text = "You are using a different URL.";
        }

        private void scraperBtn_Click(object sender, EventArgs e)
        {
            // Get text written in text box as an url
            string url = urlTextBox.Text;

            /* The "links page" is parsed differently than the actual recipe pages.
            * This checkbox determines whether a single recipe is to be scraped,
            * or a links page. */
            bool state = false;
            if (doLinksCheckBox.Checked == true)
                state = true;

            // Use url to get the website's source code
            string sourceCode = WebScraper.getSourceCode(url, state);

            // Write the sourceCode to a file
            StreamWriter streamWrite = new StreamWriter("SQL_Query.txt");
            streamWrite.Write(sourceCode);
            streamWrite.Close();
        }

        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Application.Exit();
        }
    }
}
